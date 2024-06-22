<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="adminDisplay.css">
    <title>Document</title>
</head>
<body>
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
            <div>Ngày chiếu: <input type="date" id="ngayChieu" style="width:165px;"></div>
            <div>Phòng chiếu: <input type="number" id="phongChieu"></div>
            <div>Số lượng vé bán: <input type="number" id="soVe"></div>
            <div>Số lượng vé đã bán: <input type="number" id="soVeDaBan"></div>
            <div>Trạng thái phim: <input type="text" id="status"></div>
            <div>Giá vé: <input type="number" id="price"></div>
        </div>
    </div>
    <footer>
        <div>
            <div class="cacPhimDangChieu"></div>
            <div class="cacPhimSapChieu"></div>
        </div>
    </footer>

    <script>
        document.getElementById('add-button').addEventListener('click', function() {
            const idPhim = document.getElementById('idPhim').value;
            const tenPhim = document.getElementById('tenPhim').value;
            const fileImage = document.getElementById('fileImage').value; // URL of the image
            const Mota = document.getElementById('Mota').value;
            const ngayChieu = document.getElementById('ngayChieu').value;
            const phongChieu = document.getElementById('phongChieu').value;
            const soVe = document.getElementById('soVe').value;
            const soVeDaBan = document.getElementById('soVeDaBan').value;
            const status = document.getElementById('status').value;
            const price = document.getElementById('price').value;

            const formData = new FormData();
            formData.append('idPhim', idPhim);
            formData.append('tenPhim', tenPhim);
            formData.append('fileImage', fileImage);
            formData.append('Mota', Mota);
            formData.append('ngayChieu', ngayChieu);
            formData.append('phongChieu', phongChieu);
            formData.append('soVe', soVe);
            formData.append('soVeDaBan', soVeDaBan);
            formData.append('status', status);
            formData.append('price', price);

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
            const tenPhim = document.getElementById('tenPhim').value;

            if (!tenPhim) {
                alert('Please enter a movie name to delete.');
                return;
            }

            const formData = new FormData();
            formData.append('tenPhim', tenPhim);

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
            const ngayChieu = document.getElementById('ngayChieu').value;
            const phongChieu = document.getElementById('phongChieu').value;
            const soVe = document.getElementById('soVe').value;
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
            formData.append('ngayChieu', ngayChieu);
            formData.append('phongChieu', phongChieu);
            formData.append('soVe', soVe);
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
            .then(movies => {
                const container = document.querySelector(containerClass);
                container.innerHTML = ''; // Clear existing content
                movies.forEach(movie => {
                    const movieDiv = document.createElement('div');
                    movieDiv.classList.add('movie');
                    movieDiv.innerHTML = `
                        <p>${movie.movie_id}</p>
                        <h3>${movie.movie_name}</h3>
                        <img src="${movie.image_movie}" alt="${movie.movie_name}" onerror="this.onerror=null;this.src='default.jpg';">
                        <p>${movie.describe_movie}</p>
                        <p>Ngày chiếu: ${movie.date}</p>
                        <p>Phòng chiếu: ${movie.screen_id}</p>
                        <p>Số vé bán: ${movie.number_tickets}</p>
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
