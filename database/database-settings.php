<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if(isset($_POST["submit-btn"]) AND (isset($_POST['db-name']) AND isset($_POST['db-user']) AND isset($_POST['db-host']))) {
        $check_connection = mysqli_connect(clean_inputs($_POST['db-host']), clean_inputs($_POST['db-user']), clean_inputs($_POST['db-pass']));
        $connection_error = false;

        if(!@$check_connection) {
            $connection_error = true;
            $error_head = "Wrong Database Connection!";
            $error_text = "Please enter <b>Username</b>, <b>Password</b>, <b>Database Host</b> correctly.";
        }
        if($connection_error and @mysqli_select_db($check_connection, clean_inputs($_POST['db-name']))) {
            $connection_error = true;
            $error_head = "Database Already Exists!";
            $error_text = "Please enter another <b>Database Name</b>.";

        }
        if (!$connection_error) {
            $db_name = clean_inputs($_POST['db-name']);
            $db_user = clean_inputs($_POST['db-user']);
            $db_pass = clean_inputs($_POST['db-pass']);
            $db_host = clean_inputs($_POST['db-host']);
            $jwt_key = bin2hex(random_bytes(32));

            $db_config_file = "<?php
error_reporting(0);

define('DB_HOST', '$db_host');
define('DB_USER', '$db_user');
define('DB_PASS', '$db_pass');
define('DB_NAME', '$db_name');
\$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
mysqli_set_charset(\$db, 'utf8');

\$key = '$jwt_key';
";

            $file_name = fopen('database/database-connection.php', 'wb');
            if (fwrite($file_name, $db_config_file)) {

                //create database:
                $sql_db = "CREATE DATABASE IF NOT EXISTS $db_name";
                if ($check_connection->query($sql_db) === TRUE) {

                    //add tables from sql file:
                    $sqlFile = "database/database_sql_file.sql";
                    $sql_table = file_get_contents($sqlFile);
                    $new_db_connection = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
                    if ($new_db_connection->multi_query($sql_table) === TRUE) {

                        header("location: ./"); // refresh page
                        echo '<script type="text/javascript">location.reload(true);</script>';
                        exit();
                    } else {
                        $error_head = "Something Went Wrong!";
                        $error_text = "Sorry, could not set the database configurations right now. Try again later.";
                    }

                } else {
                    $error_head = "Something Went Wrong!";
                    $error_text = "Sorry, could not set the database configurations right now. Try again later.";
                }

            } else {
                $error_head = "Something Went Wrong!";
                $error_text = "Sorry, could not set the database configurations right now. Try again later.";
            }
            fclose($file_name);

        } else {
            $error_head = "Something Went Wrong!";
            $error_text = "Sorry, could not set the database configurations right now. Try again later.";
        }

    }
}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="description" content="">
<meta name="keywords" content="">
<title>Set Database Configurations</title>
<link rel="icon" href="">
<link rel="stylesheet" href="<?php echo $website_link; ?>/assets/css/font-awesome.min.css">
<style>
* {
    border: 0;
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}
@font-face {
    font-family: 'CustomFontEnglish';
    src: url('<?php echo $website_link; ?>/assets/fonts/inter-regular.ttf') format('truetype');
}
html {
    text-rendering: optimizeLegibility;
    -webkit-font-kerning: normal;
    font-kerning: normal;
    -webkit-text-size-adjust: 100%;
    -moz-text-size-adjust: 100%;
    -ms-text-size-adjust: 100%;
    text-size-adjust: 100%;
}
body {
    margin: 0;
    border: 0;
    background-color: #F0F0F1 !important;
    font-family: 'CustomFontEnglish', Arial, sans-serif, arial;
    color: #333333;
    font-size: 16px;
}
select {
    color: #44443d;
    padding: 0 5px;
    border: 1px solid rgb(203, 203, 203);
    height: 35px;
    width: 100%;
    outline: none;
    font-size: 16px;
    text-align: left;
    background-color: #f5f5f5;
    border-radius: 4px;
}
button {
    background: rgba(207, 216, 220, 0.5);
    padding: 7px 15px;
    border: 1px solid #208296;
    color: #208296;
    border-radius: 4px;
    outline: none;
    cursor: pointer;
    font-size: 16px;
    text-decoration: none;
    white-space: nowrap;
    margin-top: 20px;
    margin-right: 10px;
}
button:hover {
    background-color: #f5f5f5;
}
table{
    width: 100%;
    border-collapse: collapse;
    margin: 0 auto;
}
table td,.table th{
    padding: 15px 15px 15px 15px;
    text-align: left;
    font-size:16px;
    vertical-align: top;
}
table tr{
    margin-bottom: 0;
    display: block;
}
table td:first-child {
    width: 160px;
}
table td:nth-child(2) input {
    width: 300px;
    vertical-align: top;
    margin-right: 20px;
    margin-bottom: 5px;
}
.table-description {
    width: 320px;
    display: inline-block;
    font-size: 14px;
}
input {
    width: 100%;
    height: 30px;
    outline: none;
    border: 1px solid #cccccc;
    padding: 0 5px;
    font-size: 14px;
    color: #333;
    border-radius: 4px;
}
input:focus {
    border: 1px solid #0F2F59;
}
@media screen and (max-width: 920px) {
    table td:nth-child(2) input {
        max-width: 350px;
        width: 100%;
    }
    .table-description {
        width: auto;
    }
}
.alpha-container-div {
    padding: 5px;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}
.main-container-div {
    background-color: #ffffff;
    padding: 10px;
    border-radius: 4px;
    box-shadow: rgba(99, 99, 99, 0.2) 0 2px 8px 0;
    overflow: auto;
    max-width: 900px;
    width: 100%;
    margin: 0 auto;
}
.padding-display-div {
    padding: 10px;
}
.padding-display-div > h2, h3 {
    margin-bottom: 30px;
    border-bottom: 1px solid #cccccc;
    padding-bottom: 10px;
}
.form-error-msg {
    text-align: left;
    background-color: rgba(255, 57, 57, 0.10);
    color: red;
    padding: 10px;
    border-radius: 4px;
    border: 1px solid red;
    font-size: 16px;
    margin-bottom: 20px;
}
.form-error-msg a {
    font-size: 14px;
    display: block;
    margin-top: 3px;
}
.form-button-div {
    display: flex;
    flex-direction: row-reverse;
    float: left;
    margin-bottom: 10px;
}
</style>
</head>
<body>
<div class="alpha-container-div">
    <div class="main-container-div">
        <div class="padding-display-div">
            <h3>Database Configurations:</h3>
            <div id="db-config-data">
                <?php
                if (isset($error_head) OR isset($error_text)) {
                    echo "
                <div class='form-error-msg'>
                <b>{$error_head}</b><br/>
                <a><i class='fa fa-lightbulb-o'></i> {$error_text}</a>
                </div>
                ";
                }
                ?>
                <form method="post" enctype="multipart/form-data">
                    <table>
                        <tbody>
                            <tr>
                                <td>
                                    <strong>Database Host</strong>
                                </td>
                                <td>
                                    <input type="text" name="db-host" value="<?php if(!empty(DB_HOST)){echo DB_HOST;}else{} ?>">
                                    <div class="table-description">
                                        <a>Your database host. 'localhost' commonly used as database host.</a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Username</strong>
                                </td>
                                <td>
                                    <input type="text" name="db-user" value="<?php if(!empty(DB_USER)){echo DB_USER;} ?>">
                                    <div class="table-description">
                                        <a>Your database username.</a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Password</strong>
                                </td>
                                <td>
                                    <input type="text" name="db-pass" value="<?php if(!empty(DB_PASS)){echo DB_PASS;} ?>">
                                    <div class="table-description">
                                        <a>Your database password. Keep this empty if password is not applicable.</a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Database Name</strong>
                                </td>
                                <td>
                                    <input type="text" name="db-name" value="<?php if(!empty(DB_NAME)){echo DB_NAME;} ?>">
                                    <div class="table-description">
                                        <a>The name of the database that you created. Installer will use this database to keep your data.</a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="form-button-div">
                        <button type="submit" name="submit-btn" id="submit-btn"><i class="fa fa-save"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>