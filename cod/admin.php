<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="adminDisplay.css">
    <title>Document</title>
</head>
<body style="background-color: brown;">
    <a href="logout.php" style="border:solid 1px black; padding:10px; margin:20px;">Đăng xuất</a>
    <div class="khungChinh">
        <div class="PhimChucNang">
            <button id="add-button">Add</button>
            <button id="delete-button">Delete</button>
            <button id="edit-button">Edit</button>
        </div>
        <div class="cacThuocTinhPhim" id="movieForm">
            <div>ID: <input type="text" id="idPhim"></div>
            <div>Tên phim: <input type="text" id="tenPhim"></div>
            <div>Ảnh: <input type="text" id="fileImage"></div>
            <div>Mô tả: <textarea id="Mota" name="message" rows="4" cols="50" style="width: 165px;"></textarea></div>
            <div>Thời lượng: <input type="number" id="thoiLuong"></div>
            <div>Đạo diễn và diễn viên: <input type="text" name="daoDien" id="daoDien"></div>
            <div>Ngày chiếu: <input type="date" id="ngayChieu" style="width:165px;"></div>
            <div>Phòng chiếu: <input type="number" id="phongChieu"></div>
            <div>Số lượng vé đã bán: <input type="number" id="soVeDaBan"></div>
            <div>Trạng thái phim: <input type="text" id="status"></div>
            <div>Giá vé: <input type="number" id="price"></div>

            <h3>Thoi Gian va phong chieu</h3>
            <div>ma chieu: <input type="int" id="showtime_id"></div>
            <div>thoi gian: <input type="time" id="thoiGian"></div>
            <div>ngayChieu: <input type="date" id="date_time"></div>
            <div>Trạng thái : <input type="text" id="status"></div>
            <div>ma Phim: <input type="" id="idPhim2"></div>
            <div class="PhimChucNang">
            <button id="add-button2">Add</button>
            <button id="delete-button2">Delete</button>
            <button id="edit-button2">Edit</button>
        </div>
        </div>
    </div>
    <footer>
        <div style="display: flex;">
            <div class="cacPhimDangChieu"></div>
            <div class="cacPhimSapChieu"></div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('add-button2').addEventListener('click', function() {
        const idPhim2 = document.getElementById('idPhim2').value;
        const thoiGian = document.getElementById('thoiGian').value;
        const date_time = document.getElementById('date_time').value;
        const status = document.getElementById('status').value;
        const showtime_id = document.getElementById('showtime_id').value;

        const formData = new FormData();
        formData.append('idPhim2', idPhim2);
        formData.append('thoiGian', thoiGian);
        formData.append('date_time', date_time);
        formData.append('status', status);
        formData.append('showtime_id', showtime_id);

        fetch('addShowtime.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });

    document.getElementById('delete-button2').addEventListener('click', function() {
        const showtime_id = document.getElementById('showtime_id').value;

        if (!showtime_id) {
            alert('Please enter a showtime ID to delete.');
            return;
        }

        const formData = new FormData();
        formData.append('showtime_id', showtime_id);

        fetch('deleteShowtime.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });

    document.getElementById('edit-button2').addEventListener('click', function() {
        const idPhim2 = document.getElementById('idPhim2').value;
        const thoiGian = document.getElementById('thoiGian').value;
        const date_time = document.getElementById('date_time').value;
        const showtime_id = document.getElementById('showtime_id').value;

        if (!showtime_id) {
            alert('Please enter a showtime ID to edit.');
            return;
        }

        const formData = new FormData();
        formData.append('idPhim2', idPhim2);
        formData.append('thoiGian', thoiGian);
        formData.append('date_time', date_time);
        formData.append('showtime_id', showtime_id);

        fetch('editShowtime.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
});

        document.getElementById('add-button').addEventListener('click', function() {
            // Lấy các giá trị từ các input fields
            const idPhim = document.getElementById('idPhim').value;
            const tenPhim = document.getElementById('tenPhim').value;
            const fileImage = document.getElementById('fileImage').value;
            const Mota = document.getElementById('Mota').value;
            const thoiLuong = document.getElementById('thoiLuong').value;
            const daoDien = document.getElementById('daoDien').value;
            const ngayChieu = document.getElementById('ngayChieu').value;
            const phongChieu = document.getElementById('phongChieu').value;
            const soVeDaBan = document.getElementById('soVeDaBan').value;
            const status = document.getElementById('status').value;
            const price = document.getElementById('price').value;

            // Tạo FormData object
            const formData = new FormData();
            formData.append('idPhim', idPhim);
            formData.append('tenPhim', tenPhim);
            formData.append('fileImage', fileImage);
            formData.append('Mota', Mota);
            formData.append('thoiLuong', thoiLuong);
            formData.append('daoDien', daoDien);
            formData.append('ngayChieu', ngayChieu);
            formData.append('phongChieu', phongChieu);
            formData.append('soVeDaBan', soVeDaBan);
            formData.append('status', status);
            formData.append('price', price);

            // Gửi request
            fetch('addMovie.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                alert(data);
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });


        document.getElementById('delete-button').addEventListener('click', function() {
            const tenPhim = document.getElementById('idPhim').value;

            if (!tenPhim) {
                alert('Please enter a movie name to delete.');
                return;
            }

            const formData = new FormData();
            formData.append('idPhim', tenPhim);

            fetch('deleteMovie.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                alert(data);
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });

        document.getElementById('edit-button').addEventListener('click', function() {
            const idPhim = document.getElementById('idPhim').value;
            const tenPhim = document.getElementById('tenPhim').value;
            const fileImage = document.getElementById('fileImage').value; 
            const Mota = document.getElementById('Mota').value;
            const thoiLuong = document.getElementById('thoiLuong').value;
            const daoDien = document.getElementById('daoDien').value;
            const ngayChieu = document.getElementById('ngayChieu').value;
            const phongChieu = document.getElementById('phongChieu').value;
            const soVeDaBan = document.getElementById('soVeDaBan').value;
            const status = document.getElementById('status').value;
            const price = document.getElementById('price').value;

            if (!idPhim) {
                alert('Please enter id movie to edit.');
                return;
            }

            const formData = new FormData();
            formData.append('idPhim', idPhim);
            formData.append('tenPhim', tenPhim);
            formData.append('fileImage', fileImage);
            formData.append('Mota', Mota);
            formData.append('thoiLuong', thoiLuong);
            formData.append('daoDien', daoDien);
            formData.append('ngayChieu', ngayChieu);
            formData.append('phongChieu', phongChieu);
            formData.append('soVeDaBan', soVeDaBan);
            formData.append('status', status);
            formData.append('price', price);

            fetch('editMovie.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                alert(data);
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });

        function fetchMovies(status, containerClass) {
            fetch(status === 'playing' ? 'getPlayingMovies.php' : 'getComingMovies.php')
            .then(response => response.json())
            .then(movies=> {
                const container = document.querySelector(containerClass);
                container.innerHTML = ''; // Clear existing content
                movies.forEach(movie => {
                    console.log('Movie image URL:', movie.image_movie); // Log the image URL
                    const movieDiv = document.createElement('div');
                    movieDiv.classList.add('movie');
                    movieDiv.innerHTML = `
                        <p>${movie.movie_id}</p>
                        <h3>${movie.movie_name}</h3>
                        <img src="${movie.image_movie}" alt="${movie.movie_name}" onerror="this.onerror=null;this.src='default.jpg'; console.error('Error loading image:', '${movie.image_movie}');">
                        <p>${movie.describe_movie}</p>
                        <p>Thời lượng: ${movie.thoiLuong}</p>
                        <p>Đạo diễn: ${movie.daoDien}</p>
                        <p>Ngày chiếu: ${movie.date}</p>
                        <p>Phòng chiếu: ${movie.screen_id}</p>
                        <p>Số vé đã bán: ${movie.number_tickets_sold}</p>
                        <p>Trạng thái: ${movie.status_movie}</p>
                        <p>Giá vé: ${movie.price}</p>
                    `;
                    container.appendChild(movieDiv);
                });
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        // Fetch and display movies when the page loads
        window.onload = function() {
            fetchMovies('playing', '.cacPhimDangChieu');
            fetchMovies('coming', '.cacPhimSapChieu');
        }
    </script>
</body>
</html>
