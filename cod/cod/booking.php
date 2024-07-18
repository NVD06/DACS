<?php
session_start();
function isLoggedIn() {
    return isset($_SESSION['userName']);
}

include "connectToDatabase.php";

$movie_name = $_GET['movie_name'];
$thoiGian = $_GET['thoiGian'];
$date = $_GET['date'];
$screen_id = $_GET['screen_id'];

// Lấy giá phim từ cơ sở dữ liệu
$sql = "SELECT price FROM tblmovie WHERE movie_name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $movie_name);
$stmt->execute();
$stmt->bind_result($moviePrice);
$stmt->fetch();
$stmt->close();

// Lấy thông tin ghế từ cơ sở dữ liệu
$sql = "SELECT seat_name, status FROM tblseat WHERE screen_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $screen_id);
$stmt->execute();
$result = $stmt->get_result();

$seats = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $seats[] = $row;
    }
}
$stmt->close();
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
    <div class="userName">
        <p style="color:aqua; cursor:pointer;"><?php echo htmlspecialchars($_SESSION['userName']); ?></p>
    </div>
    <div class="container">
        <h1>Tên phim: <?php echo htmlspecialchars($movie_name); ?></h1>
        <h1>Ngày chiếu: <?php echo htmlspecialchars($date); ?></h1>
        <h1>Giờ chiếu: <?php echo htmlspecialchars($thoiGian); ?></h1>
        <h1>Phòng chiếu: <?php echo htmlspecialchars($screen_id); ?></h1>
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
                <div class="section-title">CHỌN GHẾ</div>
                <div class="seat-screen"><h1>Màn Hình</h1></div>
                <div class="seat-grid" id="seatGrid">
                    <?php foreach ($seats as $seat): ?>
                    <div class="seat <?= $seat['status'] == 'available' ? '' : 'unavailable'; ?>">
                        <?= htmlspecialchars($seat['seat_name']); ?>
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

            <div class="/* The `total-price` section in the HTML is responsible for displaying the
            total price of the booking. It calculates the total price based on the
            selected number of tickets, the movie price retrieved from the database, and
            the selected food items with their respective prices. */
            total-price">
                Tổng: <span>0</span>
            </div>
            <button class="btn-book">Đặt Vé</button>
        </div>
    </div>

    <script>
        const seatGrid = document.getElementById('seatGrid');
        const numTicketsSelect = document.getElementById('num-tickets');
        const totalPriceElem = document.querySelector('.total-price span');
        const btnBook = document.querySelector('.btn-book');
        const foodItems = document.querySelectorAll('.food-item');

        let selectedSeats = [];
        let selectedFood = {'COMBO SOLO': 0, 'COMBO COUPLE': 0, 'COMBO PARTY': 0};
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

        function loadSeats(screen_id) {
            fetch(`get_seats.php?screen_id=${screen_id}`)
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

        foodItems.forEach(item => {
            const minusBtn = item.querySelector('.minus');
            const plusBtn = item.querySelector('.plus');
            const quantityElem = item.querySelector('span');
            const foodName = item.querySelector('div:nth-child(2)').textContent.trim();

            plusBtn.addEventListener('click', () => {
                selectedFood[foodName]++;
                quantityElem.textContent = selectedFood[foodName];
                updateTotalPrice();
            });

            minusBtn.addEventListener('click', () => {
                if (selectedFood[foodName] > 0) {
                    selectedFood[foodName]--;
                    quantityElem.textContent = selectedFood[foodName];
                    updateTotalPrice();
                }
            });
        });

        btnBook.addEventListener('click', () => {
        if (selectedSeats.length !== ticketCount) {
            alert('Vui lòng chọn đủ số lượng ghế.');
            return;
        }

        const bookingData = {
            date: <?= json_encode($date) ?>,
            time: <?= json_encode($thoiGian) ?>,
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
                window.location.href = data.redirect;
            } else {
                alert('Đặt vé thất bại: ' + data.message);
            }
        })
        .catch(error => console.error('Lỗi khi đặt vé:', error));
    });


        // Gọi hàm loadSeats với screen_id khi trang được tải
        loadSeats(<?= json_encode($screen_id) ?>);
    </script>
</body>
</html>
