<?php
// Database connection
$host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "movie_app";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db_name", $db_user, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Fetch movies
$stmt = $pdo->query("SELECT id, thumbnail_path, title, genre FROM movies");
$movies = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Movies</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            min-height: 100vh;
        }

         .sidebar {
      width: 250px;
      background-color: #2b2b2b;
      color:#fff;
      height: 100vh;
      position: fixed;
    }
    .sidebar a {
      color: #fff;
      text-decoration: none;
      padding: 10px 20px;
      display: block;
    }
    .sidebar a:hover {
      background-color: #444;
    }
    .sidebar .logo img {
        padding: 15px 20px;
        width: 10em;
    }

        .content {
            margin-left: 250px;
            padding: 20px;
            flex: 1;
            background: #f4f4f4;
        }

        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .content-header h1 {
            font-size: 1.5rem;
        }

        .content-header .create-btn {
            background: red;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .content-header .create-btn:hover {
            background: red;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .table thead {
            background: #2b2b2b;
            color: #fff;
        }

        .table thead th {
            padding: 15px;
            text-align: left;
        }

        .table tbody td {
            padding: 15px;
            border-bottom: 1px solid #eee;
        }

        .table tbody tr:hover {
            background: #f9f9f9;
        }

        .actions button {
            margin-right: 10px;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            color: #fff;
            cursor: pointer;
        }

        .actions .edit-btn {
            background: #ffa500;
        }

        .actions .delete-btn {
            background: #f44336;
        }

        .actions .view-btn {
            background: #4caf50;
        }
        .table img{
            width: 100px;
            height: 50px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo"><img src="/images/logo.png" alt=""></div>
        <a href="admin.php"><i class="fa fa-home me-2"></i> Home</a>
        <a href="movies.php"><i class="fa fa-film me-2"></i> Movies</a>
        <a href="#"><i class="fa fa-tv me-2"></i> TV Series</a>
        <a href="#"><i class="fa fa-ad me-2"></i> Advertisment</a>
        <a href="#"><i class="fa fa-tags me-2"></i> Genre</a>
        <a href="#"><i class="fa fa-wallet me-2"></i> Earning</a>
        <a href="#"><i class="fa fa-circle-exclamation me-2"></i>Any Errors</a>
        <a href="users.html"><i class="fa fa-user me-2"></i> Users</a>
        <a href="#"><i class="fa fa-box me-2"></i> Membership Packages</a>
        <a href="#"><i class="fa fa-chart-bar me-2"></i> Report</a>
        <a href="#"><i class="fa fa-cog me-2"></i> Settings</a>
      </div>
      <div class="content">
    <div class="content-header">
        <h1>Manage Movies</h1>
        <a href="create movie.php"><button class="create-btn">Create Movie</button></a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Thumbnail</th>
                <th>Movie Title</th>
                <th>Genre</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($movies)): ?>
                <?php foreach ($movies as $index => $movie): ?>
                    <tr>
                        <td><?php echo $index + 1; ?></td>
                        <td><img src="<?php echo htmlspecialchars($movie['thumbnail_path']); ?>" alt="Thumbnail" width="100"></td>
                        <td><?php echo htmlspecialchars($movie['title']); ?></td>
                        <td><?php echo htmlspecialchars($movie['genre']); ?></td>
                        <td class="actions">
                            <a href="play.php?id=<?php echo $movie['id']; ?>"><button class="view-btn">View</button></a>
                            <a href="create movie.php?id=<?php echo $movie['id']; ?>"><button class="edit-btn">Edit</button></a>
                            <a href="delete_movie.php?id=<?php echo $movie['id']; ?>"><button class="delete-btn">Delete</button></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No movies found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>
