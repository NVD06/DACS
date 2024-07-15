<?php
include "connectToDatabase.php";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$seats = [];

$sql = "SELECT * FROM tblseat";
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
            <div class="ticket-selection">
                <label for="num-tickets">Số lượng vé:</label>
                <select id="num-tickets">
                    <?php for ($i = 1; $i <= 10; $i++): ?>
                    <option value="<?= $i ?>"><?= $i ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="seat-selection">
                <div class="section-title">CHỌN GHế</div>
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
    </div>

    <script>
        const seatGrid = document.querySelector('.seat-grid');
        const numTicketsSelect = document.getElementById('num-tickets');
        const totalPriceElem = document.querySelector('.total-price span');
        const btnBook = document.querySelector('.btn-book');

        let selectedSeats = [];
        let selectedFood = {};
        let ticketCount = parseInt(numTicketsSelect.value);

        const foodPrices = {
            'COMBO SOLO': 84000,
            'COMBO COUPLE': 105000,
            'COMBO PARTY': 199000
        };

        function updateTotalPrice() {
            let totalPrice = 0;
            totalPrice += ticketCount * <?= $moviePrice; ?>;
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

        numTicketsSelect.addEventListener('change', () => {
            ticketCount = parseInt(numTicketsSelect.value);
            selectedSeats = [];
            const selectedSeatElems = seatGrid.querySelectorAll('.seat.selected');
            selectedSeatElems.forEach(seat => seat.classList.remove('selected'));
            updateTotalPrice();
        });

        seatGrid.addEventListener('click', e => {
            if (e.target.classList.contains('seat') && !e.target.classList.contains('unavailable')) {
                if (selectedSeats.length < ticketCount || e.target.classList.contains('selected')) {
                    e.target.classList.toggle('selected');
                    const seatName = e.target.textContent.trim();
                    if (e.target.classList.contains('selected')) {
                        selectedSeats.push(seatName);
                    } else {
                        selectedSeats = selectedSeats.filter(seat => seat !== seatName);
                    }
                    updateTotalPrice();
                }
            }
        });

        // Event listeners for food items remain the same

        btnBook.addEventListener('click', () => {
            if (selectedSeats.length !== ticketCount) {
                alert('Vui lòng chọn đủ số lượng ghế.');
                return;
            }

            const bookingData = {
                date: new Date().toISOString().split('T')[0],
                time: new Date().toLocaleTimeString('vi-VN', { hour: '2-digit', minute: '2-digit' }),
                seats: selectedSeats,
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
