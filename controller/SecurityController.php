<?php
namespace Controller;

use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\UserManager;
use App\Session;
use Model\Entities\User;

class SecurityController extends AbstractController{
    // contiendra les méthodes liées à l'authentification : register, login et logout

    // Méthode pour enregister un nouvel utilisateur
    public function register() 
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $userName = filter_input(INPUT_POST,'userName', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? null;
            $mail = filter_input(INPUT_POST, "mail", FILTER_SANITIZE_EMAIL) ?? null;
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? null;
            $confirmPassword = filter_input(INPUT_POST, "confirmPassword", FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? null;

            if ($userName && $mail && $password && $confirmPassword)
            {
                
                if ($password != $confirmPassword)
                {
                    $_SESSION['passError'] = 'Les passwords ne correspondent pas';
                    header("Location: index.php?ctrl=security&action=register");
                    exit();
                }
                
                if (!filter_var($mail, FILTER_VALIDATE_EMAIL))
                {
                    $_SESSION['mailError'] = "L'email n'est pas valide";
                    header("Location: index.php?ctrl=security&action=register");
                    exit();
                }
                
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                
                $userManager = new UserManager();
                
                 if ($userManager->userNameExist($userName))
                {
                    $_SESSION['nameError'] = 'Le pseudo existe déja';
                    header("Location: index.php?ctrl=security&action=register");
                    exit();
                }

                $userManager->addUser
                ([
                    'userName' => $userName,
                    'password' => $passwordHash,
                    'mail' => $mail,
                ]);

                $this->redirectTo("forum", "index");

            }
        }

        return
        [
            "view" => VIEW_DIR."forum/register.php",
            "meta_description" => "Sign in"
        ];

        
    }



    public function login() 
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $userName = filter_input(INPUT_POST, 'userName', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? null;
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? null;

            if ($userName && $password)
            {
                // Initialise un nouvel objet User
                $userManager = new UserManager();
                $user = $userManager->userNameExist($userName);

                // Vérifie que l'utilisateur existe dans la BDD, sinon renvoie une erreur
                if (!$user)
                {
                    $_SESSION['nameError'] = "Cet utilisateur n'existe pas";
                    header("Location: index.php?ctrl=security&action=login");
                    exit();
                }

                // Vérifies que le mot de passe correspond
                if (password_verify($password, $user["password"]))
                {
                    // Si c'est le cas crée un objet user
                    $userObject = new User($user);

                    // Enregistre l'objet utilisateur dans la session
                    Session::setUser($userObject);

                    // Redirige à la page d'accueil
                    $this->redirectTo("forum", "index");
                }
                else
                {
                    // Sinon renvoie au formulaire et affiche l'erreur
                    $_SESSION['passError'] = 'Password incorrect';
                    header("Location: index.php?ctrl=security&action=login");
                    exit();
                }

            }
        }

        // Redirige vers le formulaire en cas d'erreur
        return
        [
            "view" => VIEW_DIR."forum/login.php",
            "meta_description" => "Log in"
        ];
    }

    public function logout () {}
}