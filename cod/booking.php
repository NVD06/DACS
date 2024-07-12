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

$sql = "SELECT price FROM tblmovie";
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
            <div class="date-selection">
                <div class="section-title">LỊCH CHIẾU</div>
                <div class="date-item selected">08/07<br>Thứ Hai</div>
                <div class="date-item">09/07<br>Thứ Ba</div>
                <div class="date-item">10/07<br>Thứ Tư</div>
            </div>

            <div class="time-selection">
                <div class="section-title">GIỜ CHIẾU</div>
                <div class="time-item selected">14:45</div>
                <div class="time-item">16:45</div>
                <div class="time-item">18:45</div>
                <div class="time-item">20:45</div>
                <div class="time-item">23:55</div>
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

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const dateItems = document.querySelectorAll('.date-item');
            const timeItems = document.querySelectorAll('.time-item');
            const seatGrid = document.querySelector('.seat-grid');
            const foodItems = document.querySelectorAll('.food-item');
            const totalPriceElem = document.querySelector('.total-price span');
            const btnBook = document.querySelector('.btn-book');

            let selectedDate = dateItems[0].textContent.trim();
            let selectedTime = timeItems[0].textContent.trim();
            let selectedSeat = '';
            let selectedFood = {};

            const foodPrices = {
                'COMBO SOLO': 84000,
                'COMBO COUPLE': 105000,
                'COMBO PARTY': 199000
            };

            function updateTotalPrice() {
                totalPrice = 0;
                if (selectedSeat) {
                    totalPrice += <?= $moviePrice; ?>;
                }
                for (let food in selectedFood) {
                    totalPrice += foodPrices[food] * selectedFood[food];
                }
                totalPriceElem.textContent = totalPrice.toLocaleString('vi-VN') + ' VNĐ';
            }

            function loadSeats() {
                fetch(`get_seats.php?date=${selectedDate}&time=${selectedTime}`)
                    .then(response => response.json())
                    .then(data => {
                        seatGrid.innerHTML = '';
                        data.forEach(seat => {
                            const seatElem = document.createElement('div');
                            seatElem.classList.add('seat', seat.status === 'available' ? '' : 'unavailable');
                            seatElem.textContent = seat.seat_name;
                            seatGrid.appendChild(seatElem);
                        });
                    })
                    .catch(error => console.error('Lỗi khi tải ghế:', error));
            }

            dateItems.forEach(item => {
                item.addEventListener('click', () => {
                    dateItems.forEach(i => i.classList.remove('selected'));
                    item.classList.add('selected');
                    selectedDate = item.textContent.trim();
                    loadSeats();
                });
            });

            timeItems.forEach(item => {
                item.addEventListener('click', () => {
                    timeItems.forEach(i => i.classList.remove('selected'));
                    item.classList.add('selected');
                    selectedTime = item.textContent.trim();
                    loadSeats();
                });
            });

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
                console.log('Selected date:', selectedDate);
                console.log('Selected time:', selectedTime);
                console.log('Selected seat:', selectedSeat);
                console.log('Selected food:', selectedFood);
                console.log('Total price:', totalPriceElem.textContent);
            });

            loadSeats();
        });
    </script>
</body>
</html>