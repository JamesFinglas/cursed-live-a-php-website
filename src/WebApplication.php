<?php
namespace Itb;

class WebApplication
{
    const PATH_TO_TEMPLATES = __DIR__ . '/../views';

    private $mainController;

    public function __construct()
    {
        //twig declaration
        $twig = new\Twig\Environment(new \Twig_Loader_Filesystem(self::PATH_TO_TEMPLATES));
        $this->mainController = new mainController($twig);
    }

    public function run()
    {
        $action = filter_input(INPUT_GET, 'action',FILTER_SANITIZE_STRING);
        if(empty($action)){
            $action = filter_input(INPUT_POST, 'action',FILTER_SANITIZE_STRING);
        }

        //var_dump($action);
        //die();

        //switch to control page access and action functions
        switch($action){

            case 'Home':
                $this->mainController->indexAction();
                break;

            case 'Cast':
                $this->mainController->castAction();
                break;

            case 'Merchandise':
                $id = filter_input(INPUT_GET, 'id',FILTER_SANITIZE_NUMBER_INT);
                $this->mainController->merchandiseAction();
                break;

            case 'Merchandise2':
                $id = filter_input(INPUT_GET, 'id',FILTER_SANITIZE_NUMBER_INT);
                $this->mainController->merchandiseAction2();
                break;

            case 'SiteMap':
                $this->mainController->siteAction();
                break;

            case 'About':
                $this->mainController->aboutAction();
                break;

            case 'Staff':
                $this->mainController->staffAction();
                break;

            case 'Admin':
                $this->mainController->adminAction();
                break;

            case 'User':
                $this->mainController->userAction();
                break;

            case 'Visitor':
                $this->mainController->visitorAction();
                break;

            case 'InsertVisitor':
                $this->mainController->insertVisitor();
                break;

            case 'DeleteVisitor':
                $this->mainController->DeleteVisitor();
                break;

            case 'UpdateVisitor':
                $this->mainController->updateVisitor();
                break;

            case 'InsertAdmin':
                $this->mainController->insertAdmin();
                break;

            case 'DeleteAdmin':
                $this->mainController->DeleteAdmin();
                break;

            case 'UpdateAdmin':
                $this->mainController->updateAdmin();
                break;

            case 'InsertStaff':
                $this->mainController->insertUser();
                break;

            case 'DeleteStaff':
                $this->mainController->deleteUser();
                break;

            case 'UpdateStaff':
                $this->mainController->updateUser();
                break;

            case 'InsertProduct':
                $this->mainController->insertProduct();
                break;

            case 'DeleteProduct':
                $this->mainController->deleteProduct();
                break;

            case 'UpdateProduct':
                $this->mainController->updateProduct();
                break;

            case 'data':
                include_once __DIR__ . '/../setup/setup_database.php';
                break;

            case 'showBio':
                $id = filter_input(INPUT_GET, 'id',FILTER_SANITIZE_NUMBER_INT);
                $this->mainController->showBio($id);
                break;

            case 'showImage':
                $id = filter_input(INPUT_GET, 'id',FILTER_SANITIZE_NUMBER_INT);
                $this->mainController->showImage($id);
                break;

            //function to process product insert form
            case 'processNewProduct':
                $description = filter_input(INPUT_POST, 'description',FILTER_SANITIZE_STRING);
                $price = filter_input(INPUT_POST, 'price',FILTER_SANITIZE_NUMBER_FLOAT);
                $image = filter_input(INPUT_POST, 'image',FILTER_SANITIZE_STRING);
                $this->mainController->processNewProductAction($description, $price, $image);
                break;

            //function to process product delete form
            case 'processDeleteProduct':
                $id = filter_input(INPUT_POST, 'id',FILTER_SANITIZE_NUMBER_INT);
                $this->mainController->processDeleteProductAction($id);
                break;

            //function to process product update form
            case 'processProductUpdate':
                $id = filter_input(INPUT_POST, 'id',FILTER_SANITIZE_NUMBER_INT);
                $description = filter_input(INPUT_POST, 'description',FILTER_SANITIZE_STRING);
                $price = filter_input(INPUT_POST, 'price',FILTER_SANITIZE_NUMBER_FLOAT);
                $image = filter_input(INPUT_POST, 'image',FILTER_SANITIZE_STRING);
                $this->mainController->processUpdateProductAction($id, $description, $price, $image);
                break;

            //function to process staff update form
            case 'processUserUpdate':
                $id = filter_input(INPUT_POST, 'id',FILTER_SANITIZE_NUMBER_INT);
                $username = filter_input(INPUT_POST, 'username',FILTER_SANITIZE_STRING);
                $password = filter_input(INPUT_POST, 'password',FILTER_SANITIZE_STRING);
                $this->mainController->processUpdateUserAction($id, $username, $password);
                break;

            //function to process staff insert form (admin/account creation)
            case 'processNewUser':
                $username = filter_input(INPUT_POST, 'username',FILTER_SANITIZE_STRING);
                $password = filter_input(INPUT_POST, 'password',FILTER_SANITIZE_STRING);
                $this->mainController->processNewUserAction($username, $password);
                break;

            //function to process staff delete form
            case 'processDeleteUser':
                $id = filter_input(INPUT_POST, 'id',FILTER_SANITIZE_NUMBER_INT);
                $this->mainController->processDeleteUserAction($id);
                break;

            //function to process admin insert form (admin/account creation)
            case 'processNewAdmin':
                $username = filter_input(INPUT_POST, 'username',FILTER_SANITIZE_STRING);
                $password = filter_input(INPUT_POST, 'password',FILTER_SANITIZE_STRING);
                $this->mainController->processNewAdminAction($username, $password);
                break;

            //function to process admin delete form
            case 'processDeleteAdmin':
                $id = filter_input(INPUT_POST, 'id',FILTER_SANITIZE_NUMBER_INT);
                $this->mainController->processDeleteAdminAction($id);
                break;

            //function to process admin update form
            case 'processAdminUpdate':
                $id = filter_input(INPUT_POST, 'id',FILTER_SANITIZE_NUMBER_INT);
                $username = filter_input(INPUT_POST, 'username',FILTER_SANITIZE_STRING);
                $password = filter_input(INPUT_POST, 'password',FILTER_SANITIZE_STRING);
                $this->mainController->processUpdateAdminAction($id, $username, $password);
                break;

            //function to process visitor insert form (admin/account creation)
            case 'processNewVisitor':
                $username = filter_input(INPUT_POST, 'username',FILTER_SANITIZE_STRING);
                $email = filter_input(INPUT_POST, 'email',FILTER_SANITIZE_STRING);
                $this->mainController->processNewVisitorAction($username, $email);
                break;

            //function to process visitor delete form
            case 'processDeleteVisitor':
                $id = filter_input(INPUT_POST, 'id',FILTER_SANITIZE_NUMBER_INT);
                $this->mainController->processDeleteVisitorAction($id);
                break;

            //function to process visitor update form
            case 'processVisitorUpdate':
                $id = filter_input(INPUT_POST, 'id',FILTER_SANITIZE_NUMBER_INT);
                $username = filter_input(INPUT_POST, 'username',FILTER_SANITIZE_STRING);
                $email = filter_input(INPUT_POST, 'email',FILTER_SANITIZE_STRING);
                $this->mainController->processUpdateVisitorAction($id, $username, $email);
                break;

            //function to process user login form
            case 'processLogin':
                $username = filter_input(INPUT_POST, 'username',FILTER_SANITIZE_STRING);
                $password = filter_input(INPUT_POST, 'password',FILTER_SANITIZE_STRING);

                //var_dump($username . $password);
                //die();

                $this->mainController->processLoginAction($username, $password);
                break;

            //function to process user logout / session kill
            case 'processLogout':
                $this->mainController->processLogoutAction();
                break;

            default:
                $this->mainController->indexAction();
        }
    }
}