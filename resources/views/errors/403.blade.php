<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>403 Forbidden</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap");

        :root {
            --primary-color: #f53d3d;
            --primary-color-dark: #d63232;
            --text-dark: #333333;
            --text-light: #767268;
            --extra-light: #ffffff;
            --bg-gradient: linear-gradient(120deg, #f53d3d, #d63232);
        }

        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--extra-light);
            font-family: "Roboto", sans-serif;
            text-align: center;
            overflow: hidden;
            background: var(--bg-gradient);
            animation: gradient-animation 6s infinite alternate;
        }

        @keyframes gradient-animation {
            0% {
                background-position: 0% 50%;
            }

            100% {
                background-position: 100% 50%;
            }
        }

        .container {
            position: relative;
            display: grid;
            grid-template-columns: 1fr;
            align-items: center;
            justify-items: center;
            gap: 2rem;
            padding: 3rem;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .header h1 {
            font-size: 6rem;
            font-weight: 900;
            color: var(--primary-color);
        }

        .header h3 {
            font-size: 2rem;
            font-weight: 700;
            color: var(--text-dark);
        }

        .container img,
        dotlottie-player {
            max-width: 100%;
            width: 300px;
            height: 300px;
        }

        .footer p {
            font-size: 1rem;
            color: var(--text-light);
            margin-bottom: 1rem;
        }

        .footer button {
            padding: 1rem 2rem;
            border: none;
            border-radius: 5px;
            background-color: var(--primary-color);
            color: var(--extra-light);
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .footer button:hover {
            background-color: var(--primary-color-dark);
        }

        @media (min-width: 640px) {
            .container {
                grid-template-columns: repeat(2, 1fr);
                text-align: left;
                gap: 3rem;
            }

            .header {
                align-self: center;
            }

            .footer {
                grid-column: span 2;
                text-align: center;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header Section -->
        <div class="header">
            <h1>403</h1>
            <h3>Akses Ditolak!</h3>
        </div>

        <!-- Animation Section -->
        <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
        <dotlottie-player src="https://lottie.host/f6a36abe-07a1-4143-8acc-33a0eeb65b7a/ueWV6L5ebl.lottie"
            background="transparent" speed="1" style="width: 300px; height: 300px" loop autoplay></dotlottie-player>

        <!-- Footer Section -->
        <div class="footer">
            <p>Maaf, Anda tidak memiliki izin untuk mengakses halaman ini. Silakan kembali ke halaman sebelumnya!</p>
            <button onclick="history.back()">KEMBALI</button>
        </div>
    </div>
</body>

</html>
