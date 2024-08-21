<?php

class Carne 
{
    private $valorTotal;
    private $qtdParcelas;
    private $dataPrimeiroVencimento;
    private $periodicidade;
    private $valorEntrada;

    public function __construct($valorTotal = 0, $qtdParcelas = 0, $dataPrimeiroVencimento = '', $periodicidade = '', $valorEntrada = 0)
    {
        $this->valorTotal               = $valorTotal;
        $this->qtdParcelas              = $qtdParcelas;
        $this->dataPrimeiroVencimento   = $dataPrimeiroVencimento;
        $this->periodicidade            = $periodicidade;
        $this->valorEntrada             = $valorEntrada;
    }

    public function parcelasMake()
    {
        $parcelas       = [];
        $valorParcela   = ($this->valorTotal - $this->valorEntrada) / $this->qtdParcelas;
        $dataVencimento = new \DateTime($this->dataPrimeiroVencimento);

        if ($this->valorEntrada > 0)
        {
            $parcelas[] = $this->parcelasResponse($dataVencimento->format('Y-m-d'), $this->valorEntrada, 1, true);
            $dataVencimento->modify($this->getModifyInterval());
        }

        for ($i = 0; $i < $this->qtdParcelas; $i++)
        {
            $parcelas[] = $this->parcelasResponse($dataVencimento->format('Y-m-d'), round($valorParcela, 2), $i + 1 + ($this->valorEntrada > 0 ? 1 : 0));
            $dataVencimento->modify($this->getModifyInterval());
        }

        return [
            'total'         => $this->valorTotal,
            'valor_entrada' => $this->valorEntrada,
            'total'         => $this->valorTotal,
            'parcelas'      => $parcelas
        ];
    }

    public function parcelasGetByCarneId(int $carneId) : array
    {   
        $res = [];

        try
        {
            if(empty($carneId)){ throw new \Exception(); }

            // Dummy, pois nao usei DB
            $this->valorTotal = 0.30;   
            $this->qtdParcelas  = 2;
            $this->dataPrimeiroVencimento = '2024-08-01';
            $this->periodicidade = 'semanal';
            $this->valorEntrada = 0.10;

            $data = $this->parcelasMake();
            if(empty($data['parcelas'])){ throw new \Exception(); }
            
            return $data['parcelas'];

        }catch(\Exception $e){}

        return $res;
    }

    private function parcelasResponse(string $dt, float $val, int $numero, bool $entrada = false) : array
    {
        return [
            'data_vencimento'   => $dt,
            'valor'             => $val,
            'numero'            => $numero,
            'entrada'           => $entrada
        ];
    }

    private function getModifyInterval()
    {
        return $this->periodicidade === 'mensal' ? '+1 month' : '+1 week';
    }
}
