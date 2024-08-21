<?php
require_once __DIR__.'/BaseController.php';
require_once __DIR__.'/../Models/Carne.php';

class CarneController extends BaseController
{
    /**
     * Method para criar o carne [POST]
     *
     * @return void
     */
    public function create() 
    {
        try
        {
            if (!$this->createValidateInput($_POST)){ throw new \Exception(); }

            $data       = $_POST;
            $carne      = new Carne($data['valor_total'], $data['qtd_parcelas'], \trim($data['data_primeiro_vencimento']), \trim($data['periodicidade']), $data['valor_entrada'] ?? 0);
            $parcelas   = $carne->parcelasMake();

            return $this->view($parcelas);

        }catch(\Exception $e){}
        
        return $this->error('Invalid input', 400);
    }

    /**
     * Method para recuperar o carne [GET]
     *
     * @return void
     */
    public function get($id)
    {
        try
        {
            if (empty($id) || !Utils::validateInt(\trim($id))){ throw new \Exception(); }

            $res = (new Carne())->parcelasGetByCarneId((int) \trim($id));
            if (empty($res)){ throw new \Exception(); }
            
            return $this->view($res);

        }catch(\Exception $e){}
        
        return $this->error('Not found', 404);
    }

    private function createValidateInput(array &$data = []) : bool
    {
        $res = false;

        try
        {
            if (count($data) == 0){ throw new \Exception(1); }
            if (empty($data['valor_total']) || empty($data['qtd_parcelas']) || empty($data['data_primeiro_vencimento']) || empty($data['periodicidade'])){ throw new \Exception(2); }
            if (!isset($data['valor_total']) || !Utils::validateFloat($data['valor_total']) || $data['valor_total'] <= 0){ throw new \Exception(3); }
            if (!isset($data['qtd_parcelas']) || !Utils::validateInt($data['qtd_parcelas']) || $data['qtd_parcelas'] <= 0){ throw new \Exception(4); }
            if (!isset($data['periodicidade']) || !in_array(\trim($data['periodicidade']), ['mensal', 'semanal'])){ throw new \Exception(5); }
            if (!isset($data['data_primeiro_vencimento']) || !Utils::validateDate(\trim($data['data_primeiro_vencimento']))){ throw new \Exception(6); }
            if (isset($data['valor_entrada']) && (!Utils::validateFloat($data['valor_entrada']) || $data['valor_entrada'] < 0)){ throw new \Exception(7); }

            $res                                = true;
            $data['periodicidade']              = \trim($data['periodicidade']);
            $data['data_primeiro_vencimento']   = \trim($data['data_primeiro_vencimento']);
            $data['qtd_parcelas']               = (int) $data['qtd_parcelas'];

        }catch(\Exception $e){} // echo $e->getMessage();
        
        return $res;
    }
}
