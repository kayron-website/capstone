<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>Document</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'poppins';
        }

        .containers {
            min-height: 100vh;
            width: 100%;
            background-color: #191a2b;
        }

        .service-wrapper {
            padding: 5% 8%;
        }

        .service {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h1 {
            color: #fff;
            font-size: 5rem;
            -webkit-text-stroke-width: 2px;
            -webkit-text-stroke-color: transparent;
            letter-spacing: 4px;
            background-color: rgb(4, 52, 83);
            background: linear-gradient(8deg, rgba(8,52,83) 0%,rgba(0,230,173,1),rgba(41,17,45,1) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            position: relative;
        }

        h1::after {
            content: "";
            position: absolute;
            top: 100%;
            left: 10%;
            height: 8px;
            width: 80%;
            border-radius: 8px;
            background-color: rgba(255, 255, 255, 0.05);
        }

        h1 span {
            position: absolute;
            top: 100%;
            left: 10%;
            height: 8px;
            width: 8px;
            border-radius: 50%;
            background-color: #72e2ae;
            animation: anim 5s linear infinite;
        }

        @keyframes anim {
            95%{
                opacity: 1;
            }
            100%{
                opacity: 0;
                left: 88%;
            }
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(3,1fr);
            gap: 30px;
            margin-top: 80px;
        }

        .card {
            height: 330px;
            width: 370px;
            background-color: #1c2335;
            padding: 3% 8%;
            border: 0.2px solid rgba(114, 226, 174, 0.2);
            border-radius: 8px;
            transition: 0.6s;
            display: flex;
            align-items: center;
            flex-direction: column;
        }
    </style>
</head>
<body>
<div class="containers">
		<div class="service-wrapper">
			<div class="service">
				<h1>Our Service<span></span></h1>
				<div class="cards">
					<div class="card">
						<i class="fa-brands fa-chromecast"></i>
						<h2>Business Strategy</h2>
						<p>Lorem asgas  asd asdfadsf sdf sdf sdg sdgdsgsdgsd fadsf sdf sdf sdg sdgdsgsdgsd fadsf sdf sdf sdg sdgdsgsdgsd</p>
					</div>
                    <div class="card">
						<i class="fa-brands fa-chromecast"></i>
						<h2>Business Strategy</h2>
						<p>Lorem asgas  asd asdfadsf sdf sdf sdg sdgdsgsdgsd fadsf sdf sdf sdg sdgdsgsdgsd fadsf sdf sdf sdg sdgdsgsdgsd</p>
					</div>
                    <div class="card">
						<i class="fa-brands fa-chromecast"></i>
						<h2>Business Strategy</h2>
						<p>Lorem asgas  asd asdfadsf sdf sdf sdg sdgdsgsdgsd fadsf sdf sdf sdg sdgdsgsdgsd fadsf sdf sdf sdg sdgdsgsdgsd</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>