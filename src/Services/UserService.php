<?php


namespace Src\Services;



use Src\Repository\UserRepository;

class UserService
{

    /**
     * @var UserRepository
     */
    private $repository;

    public function __construct($repository = null)
    {
        $this->repository = $repository ?? new UserRepository();
    }

    public function all()
    {
        return $this->repository->all();
    }

    public function get($id)
    {
        return $this->repository->get($id);
    }

    public function register()
    {

        $input = (array) json_decode(file_get_contents('php://input'), TRUE);
        if (! $this->validate($input)) {
            throw new \Exception('Invalid input data');
        }

        $input['password'] = $this->makeToken($input['password']);
        return $this->repository->insert($input);
    }

    public function login($input)
    {
        return var_dump($this->repository->login($input));
    }

    public function update($id,Array $input)
    {
        return $this->repository->update($id,$input);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }

    public function validate($input)
    {
        $mobile = $this->repository->get($input['mobile'],'mobile');
        $email = $this->repository->get($input['email'],'email');
        if(!empty($mobile) || !empty($email))
            throw new \Exception('Data is not unique');

        if (! isset($input['name']))
            return false;

        if (! isset($input['email']))
            return false;

        return true;
    }

    /**
     *
     *
     *
     * Just for not using package !
     *
     *
     */
    public function makeToken($id)
    {
        $secret = getenv('SECRET');
        $header = json_encode([
            'typ' => 'JWT',
            'alg' => 'HS256'
        ]);
        $payload = json_encode([
            'user_id' => 1,
            'role' => 'admin',
            'exp' => 1593828222
        ]);
        $base64UrlHeader = base64UrlEncode($header);
        $base64UrlPayload = base64UrlEncode($payload);
        $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, $secret, true);
        $base64UrlSignature = base64UrlEncode($signature);

        $jwt = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;
        return $jwt;
    }

    public function unprocessableEntityResponse()
    {
        $response['status_code_header'] = 'HTTP/1.1 422 Unprocessable Entity';
        $response['body'] = json_encode([
            'error' => 'Invalid input'
        ]);
        return $response;
    }

    public function notFoundResponse()
    {
        $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
        $response['body'] = null;
        return $response;
    }

}