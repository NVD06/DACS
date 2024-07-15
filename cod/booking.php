<?php
include "connectToDatabase.php";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$seats = [];

$sql = "SELECT seat_name, status FROM tblseat";
$result = $conn->query($sql);

if ($result) {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $seats[] = $row;
        }
    } else {
        echo "Không tìm thấy ghế nào";
    }
} else {
    echo "Lỗi truy vấn: " . $conn->error;
}

$moviePrice = 0;

$sql = "SELECT movie_name, price FROM tblmovie";
$result = $conn->query($sql);

if ($result) {
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $moviePrice = $row['price'];
    } else {
        echo "Không tìm thấy giá phim";
    }
} else {
    echo "Lỗi truy vấn: " . $conn->error;
}

$conn->close();

$date = $_GET['date'] ?? '';
$time = $_GET['time'] ?? '';
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt Vé Xem Phim</title>
    <link rel="stylesheet" href="booking.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="container">
        <h1>Vui lòng lựa chọn thông tin</h1>
        <div class="book-tickets">
            
            <div class="seat-selection">
                <div class="section-title">CHỌN GHẾ</div>
                <div class="seat-screen"><h1>Màn Hình</h1></div>
                <div class="seat-grid">
                    <?php foreach ($seats as $seat): ?>
                    <div class="seat <?= $seat['status'] == 'available' ? '' : 'unavailable'; ?>">
                        <?= $seat['seat_name']; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="food-selection">
                <div class="section-title">CHỌN BẮP NƯỚC</div>
                <div class="food-item">
                    <img src="./images/Combo-Solo.png" alt="Combo Solo">
                    <div>COMBO SOLO</div>
                    <div>1 Bắp + 1 Coca</div>
                    <div>84,000 VNĐ</div>
                    <button class="minus">-</button><span>0</span><button class="plus">+</button>
                </div>
                <div class="food-item">
                    <img src="./images/Combo-Couple.png" alt="Combo Couple">
                    <div>COMBO COUPLE</div>
                    <div>Combo 1 Bắp + 2 Coca</div>
                    <div>105,000 VNĐ</div>
                    <button class="minus">-</button><span>0</span><button class="plus">+</button>
                </div>
                <div class="food-item">
                    <img src="./images/Combo-Party.png" alt="Combo Party">
                    <div>COMBO PARTY</div>
                    <div>Combo 2 bắp + 4 Coca</div>
                    <div>199,000 VNĐ</div>
                    <button class="minus">-</button><span>0</span><button class="plus">+</button>
                </div>
            </div>

            <div class="total-price">
                Tổng: <span>0</span> VNĐ
            </div>
            <button class="btn-book">Đặt Vé</button>
        </div>
    </div>

    <script>
        const seatGrid = document.querySelector('.seat-grid');
        const foodItems = document.querySelectorAll('.food-item');
        const totalPriceElem = document.querySelector('.total-price span');
        const btnBook = document.querySelector('.btn-book');

        let selectedSeat = '';
        let selectedFood = {};
        const moviePrice = <?= $moviePrice; ?>;

        const foodPrices = {
            'COMBO SOLO': 84000,
            'COMBO COUPLE': 105000,
            'COMBO PARTY': 199000
        };

        function updateTotalPrice() {
            let totalPrice = 0;
            if (selectedSeat) {
                totalPrice += moviePrice;
            }
            for (let food in selectedFood) {
                totalPrice += foodPrices[food] * selectedFood[food];
            }
            totalPriceElem.textContent = totalPrice.toLocaleString('vi-VN') + ' VNĐ';
        }

        function loadSeats() {
            fetch(`get_seats.php`)
                .then(response => response.json())
                .then(data => {
                    seatGrid.innerHTML = '';
                    data.seats.forEach(seat => {
                        const seatElem = document.createElement('div');
                        seatElem.classList.add('seat', seat.status === 'available' ? '' : 'unavailable');
                        seatElem.textContent = seat.seat_name;
                        seatGrid.appendChild(seatElem);
                    });
                })
                .catch(error => console.error('Lỗi khi tải ghế:', error));
        }

        seatGrid.addEventListener('click', e => {
            if (e.target.classList.contains('seat') && !e.target.classList.contains('unavailable')) {
                const selectedSeatElem = seatGrid.querySelector('.seat.selected');
                if (selectedSeatElem) {
                    selectedSeatElem.classList.remove('selected');
                }
                e.target.classList.add('selected');
                selectedSeat = e.target.textContent.trim();
                updateTotalPrice();
            }
        });

        foodItems.forEach(item => {
            const minus = item.querySelector('.minus');
            const plus = item.querySelector('.plus');
            const count = item.querySelector('span');
            const foodName = item.querySelector('div:nth-child(2)').textContent.trim();

            minus.addEventListener('click', () => {
                let value = parseInt(count.textContent);
                if (value > 0) {
                    value--;
                    count.textContent = value;
                    selectedFood[foodName] = value;
                    updateTotalPrice();
                }
            });

            plus.addEventListener('click', () => {
                let value = parseInt(count.textContent);
                value++;
                count.textContent = value;
                selectedFood[foodName] = value;
                updateTotalPrice();
            });
        });

        btnBook.addEventListener('click', () => {
            const bookingData = {
                date: '<?= $date; ?>',
                time: '<?= $time; ?>',
                seat: selectedSeat,
                food: selectedFood,
                total_price: totalPriceElem.textContent
            };

            fetch('save_ticket.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(bookingData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Đặt vé thành công');
                    loadSeats();
                } else {
                    alert('Đặt vé thất bại: ' + data.message);
                }
            })
            .catch(error => console.error('Lỗi khi đặt vé:', error));
        });
        
        loadSeats();
    </script>
</body>
</html>