<?php namespace App;
use App\Models\Customer;

class Console{
    private const LOGIN = 1;
    private const REGISTER = 2;

    private const DEPOSIT = 1;
    private const WITHDRAW = 2;
    private const TRANSFER = 5;
    private const VIEW_DEPOSIT = 3;
    private const VIEW_WITHDRAW = 4;
    private const VIEW_BALLANCE = 6;

    private const EXIT = 0;


    private array $authOptions = [
        self::LOGIN => 'Login',
        self::REGISTER => 'Register',
        self::EXIT => 'Exit'
    ];

    private array $customerOptions = [
        self::DEPOSIT => 'Deposit',
        self::WITHDRAW => 'Withdraw',
        self::TRANSFER => 'Transfer',
        self::VIEW_DEPOSIT => 'View Deposit',
        self::VIEW_WITHDRAW => 'View Deposit',
        self::VIEW_BALLANCE => 'View Ballance',
        self::EXIT => 'Exit',
    ];

    public function run(){
        while(true) {
            foreach($this->authOptions as $key => $value){
                print $key.' - '.$value.PHP_EOL;
            }

            $choice = (int) readline('Please Select a Option to Proceed: ');
            
            switch ($choice) {
                case self::LOGIN:
                    $this->login();
                    break;
                case self::REGISTER:
                    $this->register();
                    break;
                case self::EXIT:
                    exit(0);
                default:
                    print 'Invalid Choice. Please Select Correct Option'.PHP_EOL;
                    break;
            }
            
        }
    }

    public function login(){
        $email = readline('Email: ');
        $password = readline('Password: ');
    }

    public function register(){
        while(true){
            $name = readline('Name: ');            
            if('' == $name){
                print '>> You must enter a name'.PHP_EOL;
                $this->register();
            }

            $email = readline('Email: ');
            if('' == $email){
                print '>> You must enter an email'.PHP_EOL;
                $this->register();
            }
            
            $password = readline('Password: ');
            if('' == $password){
                print ">> You can't set an emppty password".PHP_EOL;
                $this->register();
            }

            $confirmPassword = readline('Confirm Password: ');            
            if($password != $confirmPassword){
                print ">> Password doesn't match. Try again...".PHP_EOL;
                $this->register();
            }

            break;
        }

        $data = [
            'name'  => $name,
            'email' => $email,
            'password' => $password
        ];

        $customer = new Customer();
        $customer->set($data);
        if($customer->register()){
            print 'User Registered Successfully'.PHP_EOL;
        }
    }
}