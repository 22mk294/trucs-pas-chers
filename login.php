<?php 
// vérifier si l'utilisateur n'est pas connecteé avant d'afficher le formulaire
//demarrer la session
session_start();

if($_SESSION['user'] ?? false){
    header('Location: create.php');
    exit();
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $user = [
        "nom" => "Admin",
        "email"=> "admin@trucspaschers.com",
        "password"=> "admin123",
    ];

    if($email === $user["email"] and $password === $user["password"]){
        //demarrer la session
        
        //créer une session pour cette utilisateur
        $_SESSION['user'] = [
            "nom" => $user["nom"],
            "email" => $user["email"],
        ];
        session_regenerate_id(true);

        //redirection
        header("Location: create.php");
        exit();
    }
    else{
        $error= "Email ou mot de passe incorrect";
    }
}
$title = "Login";
//$header = "Page login";
?>
<?php require 'composants/head.php'; ?>
<?php require 'composants/nav.php'; ?>
<?php require 'composants/main.php'; ?>



<form class="max-w-sm mx-auto" action="login.php" method="POST">
  <div class="mb-5">
    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
    <input type="email" id="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="trucspaschers@.com" required />
  </div>
  <div class="mb-5">
    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mot de passe</label>
    <input type="password" id="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
  </div>
  <?php if($error ?? false) : ?>

  <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
  <span class="font-medium"><?php echo $error ?></span> 
</div>
  <?php endif; ?>
  <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Se connecter</button>
</form>


<?php require 'composants/footer.php'; ?>