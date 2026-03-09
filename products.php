<?php
	session_start();
	include 'db.php';

	// التأكد إن المستخدم عامل تسجيل دخول
	if (!isset($_SESSION['user_id'])) {
		header("Location: index.php");
		exit();
	}

	$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Products Page</title>

	<!-- CSS -->
	<link rel="stylesheet" href="products.css">

	<!-- Bootstrap -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

	<!-- Icons -->
	<link href="https://cdn.jsdelivr.net/npm/remixicon@4.9.1/fonts/remixicon.min.css" rel="stylesheet">

</head>

<body>

	<!-- ===== Scroll Up Button ===== -->
	<div id="progress">
		<span id="progress-value">&#x1F815;</span>
	</div>

	<section class="hero">

		<header>

			<div class="container">

				<!-- ===== Navbar ===== -->
				<nav>

					<div class="logo">
						Everything Under Control
					</div>

					<ul class="nav-links">

						<li><a href="products.php">Menu</a></li>
						<li><a href="about.php">About</a></li>
						<li><a href="Contact Us.php">Contact</a></li>
						<li><a href="my_orders.php">My Orders</a></li>
						<li class="li"><a href="index.php">LOGOUT</a></li>
						<li><a href="home.php">Home</a></li>

					</ul>

					<!-- ===== Search ===== -->
					<div class="search">

						<input
							type="text"
							class="search_input"
							placeholder="Search"
						>

						<div class="search_icon">
							<i class="ri-search-line"></i>
						</div>

					</div>

					<!-- ===== السلة ===== -->
					<div class="cart" onclick="toggleCart()">

						<span id="cartCount">
							0
						</span>

						<i class="ri-shopping-basket-2-line"></i>

					</div>

				</nav>

			</div>

		</header>

	</section>


	<!-- ===== SVG Effect ===== -->
	<svg class="svg-container" width="0" height="0">

		<defs>

			<filter id="turbulent-displace"
				color-interpolation-filters="sRGB"
				x="-20%"
				y="-20%"
				width="140%"
				height="140%">

				<feTurbulence
					type="turbulence"
					baseFrequency="0.02"
					numOctaves="10"
					result="noise1"
					seed="1"
				/>

				<feOffset in="noise1" dx="0" dy="0" result="offsetNoise1">
					<animate attributeName="dy" values="700;0" dur="6s" repeatCount="indefinite"/>
				</feOffset>

				<feTurbulence
					type="turbulence"
					baseFrequency="0.02"
					numOctaves="10"
					result="noise2"
					seed="2"
				/>

				<feOffset in="noise2" dx="0" dy="0" result="offsetNoise2">
					<animate attributeName="dy" values="0;-700" dur="6s" repeatCount="indefinite"/>
				</feOffset>

				<feTurbulence
					type="turbulence"
					baseFrequency="0.02"
					numOctaves="10"
					result="noise3"
					seed="3"
				/>

				<feOffset in="noise3" dx="0" dy="0" result="offsetNoise3">
					<animate attributeName="dx" values="490;0" dur="6s" repeatCount="indefinite"/>
				</feOffset>

				<feTurbulence
					type="turbulence"
					baseFrequency="0.02"
					numOctaves="10"
					result="noise4"
					seed="4"
				/>

				<feOffset in="noise4" dx="0" dy="0" result="offsetNoise4">
					<animate attributeName="dx" values="0;-490" dur="6s" repeatCount="indefinite"/>
				</feOffset>

				<feComposite in="offsetNoise1" in2="offsetNoise2" result="part1"/>
				<feComposite in="offsetNoise3" in2="offsetNoise4" result="part2"/>

				<feBlend in="part1" in2="part2" mode="color-dodge" result="combinedNoise"/>

				<feDisplacementMap
					in="SourceGraphic"
					in2="combinedNoise"
					scale="30"
					xChannelSelector="R"
					yChannelSelector="B"
				/>

			</filter>

		</defs>

	</svg>


	<div class="search-results">

	<?php

		// ===== جلب المنتجات من قاعدة البيانات =====
		$sql = "SELECT * FROM products";
		$result = $conn->query($sql);

		// ===== التأكد إن فيه منتجات =====
		if ($result->num_rows > 0) {

			while ($row = $result->fetch_assoc()) {

				$product_id = $row['product_id'];
	?>

		<!-- ===== Product Card ===== -->
		<div class="card-container"

			data-name="<?php echo $row['name']; ?>"
			data-price="<?php echo $row['price']; ?>"
			data-default-image="images/<?php echo $row['image']; ?>"
			data-default-price="<?php echo $row['price']; ?>">

			<div class="inner-container">

				<div class="border-outer">
					<div class="main-card"></div>
				</div>

				<div class="glow-layer-1"></div>
				<div class="glow-layer-2"></div>

			</div>

			<div class="overlay-1"></div>
			<div class="overlay-2"></div>

			<div class="info">

				<!-- صورة المنتج -->
				<img
					src="images/<?php echo $row['image']; ?>"
					alt="<?php echo $row['name']; ?>"
					class="potato"
					loading="lazy"
					decoding="async"
				>

				<div class="go">

					<!-- اسم المنتج  -->
					<h2 data-original-name="<?php echo htmlspecialchars($row['name']); ?>">
						<?php echo $row['name']; ?>
					</h2>

					<!-- سعر المنتج -->
					<h6>
						Price:
						<span><?php echo $row['price']; ?></span>
						EGP
					</h6>

					<!-- بيشوف لو المنتج متوفر ولا لا  -->
					<?php if ($row['stock_quantity'] > 0): ?>
                        <!-- زر اضافة الى السلة  -->
						<button
							class="add-to-cart"
							data-id="<?php echo $row['product_id']; ?>"    
							data-name="<?php echo htmlspecialchars($row['name']); ?>"
							data-price="<?php echo $row['price']; ?>"
						>

							<div class="background"></div>

							<span>Add To Cart</span>

							<div class="cart-icon">
								<svg viewBox="0 0 24 24">
									<circle cx="10" cy="20" r="2"/>
									<circle cx="18" cy="20" r="2"/>
									<path d="M2 2h4l2 12h12"/>
								</svg>
							</div>

							<div class="check">
								<svg viewBox="0 0 24 24">
									<path d="M4 12l6 6l10-10"/>
								</svg>
							</div>

						</button>
                    <!-- لو المنتج مش موجود يطبع الجملة ده  -->
					<?php else: ?>

						<button class="add-to-cart disabled-stock" disabled>
							<div class="background"></div>
							<span>Out Of Stock</span>
						</button>

					<?php endif; ?>

					<?php
						// ===== جلب النكهات =====
						$flavors_sql = "SELECT * FROM product_flavors WHERE product_id = $product_id";
						$flavors_result = $conn->query($flavors_sql);

						if ($flavors_result->num_rows > 0):
					?>
						<div class="flavor-container">
                            <!-- قائمة النكهات ال dropdown  -->
							<select class="flavor-select" data-product-id="<?php echo $product_id; ?>">
								<option value="">Choose Flavor</option>
                                <!-- عرض كل ناكهة  -->
								<?php while ($flavor = $flavors_result->fetch_assoc()): ?>
									<option
										value="<?php echo $flavor['flavor_id']; ?>"
										data-name="<?php echo $flavor['flavor_name']; ?>"
										data-image="<?php echo $flavor['image']; ?>"
										data-price="<?php echo $flavor['price']; ?>"
									>
										<?php echo $flavor['flavor_name']; ?>
									</option>
								<?php endwhile; ?>
							</select>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	<?php
			}//لو مفيش منتجات يطبع الجملة ده
		} else {
			echo "<p style='color:white; text-align:center;'>No products available</p>";
		}
	?>
	</div>

	<!-- ===== CART POPUP ===== -->
	<div class="cart-popup" id="cartPopup">
		<h3>Your Cart</h3>
		<ul id="cartItems"></ul>
		<div class="total">
			Total: <span id="totalPrice">0</span> EGP
		</div>
		<button class="close-btn" onclick="closeCart()">
			Close
		</button>
		<button class="clear-btn" onclick="clearCart()">
			Clear All
		</button>
		<button class="confirm-btn" onclick="confirmOrder()">
			Confirm Order
		</button>
	</div>

	<script defer src="products.js"></script>
</body>
</html>