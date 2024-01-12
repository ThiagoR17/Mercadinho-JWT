<?php

//Aqui, estou criando duas classes. A classe Venda está estendendo a classe Produto, o que significa que Venda herda os atributos e métodos da classe Produto.

class Produto {
    public $nome;
    public $preco;
    public $quantidade;

    
    //O método setProduto pertence à classe Produto. Ele recebe um array chamado $data como parâmetro e utiliza as informações desse array para configurar os atributos nome, preco, e quantidade do objeto Produto.
    //Para a melhor robustez do código, utilizei tratamento de exceções, permitindo que identifique e trate os erros de forma eficiente.
     
    public function setProduto(array $data): void {
        if (isset($data['nome'])) {
            $this->nome = $data['nome'];
        } else {
            throw new Exception("O nome do produto é obrigatório.");
        }

        if (isset($data['preco'])) {
            $this->preco = $data['preco'];
        } else {
            throw new Exception("O preço do produto é obrigatório.");
        }

        if (isset($data['quantidade'])) {
            $this->quantidade = $data['quantidade'];
        } else {
            throw new Exception("A quantidade do produto é obrigatória.");
        }
    }
    
    
    //O método getProduto é responsável por exibir as informações salvas
    public function getProduto(): void {
        echo "Produto:\n";
        echo "Nome: {$this->nome}\n";
        echo "Preço: {$this->preco}\n";
        echo "Quantidade em Estoque: {$this->quantidade}\n";
        echo "------------------------\n";
    }
}

class Venda extends Produto {
    public $quantidadeVenda;
    public $desconto;

//criei um construtor para garantir que a criação de uma venda seja sempre associada a um produto específico.
    public function __construct(Produto $produto) {
        $this->nome = $produto->nome;
        $this->preco = $produto->preco;
        $this->quantidade = $produto->quantidade;
    }


    
//O método getVenda utiliza o $data como parâmetro e utiliza as informações desse array para configurar os atributos quantidadeVenda e desconto da classe Venda.
        public function getVenda(): void {
        echo "Venda realizada com sucesso:\n";
        echo "Nome do Produto: {$this->nome}\n";
        echo "Quantidade Vendida: {$this->quantidadeVenda}\n";
        echo "Desconto: {$this->desconto}\n";
        echo "Estoque Atualizado: {$this->quantidade}\n";
        echo "------------------------\n";
    }

    /**
     * O método setVenda utiliza o $data como parâmetro 
     * e utiliza as informações desse array para configurar os atributos quantidadeVenda e desconto da classe Venda.
     */
    public function setVenda(array $data): void {
        if (isset($data['quantidadeVenda']) && isset($data['desconto'])) {
            // Verifica se a quantidade vendida é maior do que a quantidade em estoque
            if ($data['quantidadeVenda'] > $this->quantidade) {
                throw new Exception("Quantidade vendida não pode ser maior do que a quantidade em estoque.");
            }
    
            // Configura a quantidade de venda e desconto
            $this->quantidadeVenda = $data['quantidadeVenda'];
            $this->desconto = $data['desconto'];
    
            // Atualiza o estoque
            $this->quantidade -= $this->quantidadeVenda;
        } else {
            throw new Exception("A quantidade de venda e o desconto são obrigatórios.");
        }
    }
    
}
//Lançando os dados do Produto
$produto = new Produto();
$dataProduto = [
    "nome" => "Produto A",
    "preco" => 20.00,
    "quantidade" => 50
];
$produto->setProduto($dataProduto);
$produto->getProduto();

$venda = new Venda($produto);

//Informações da venda
$dataVenda = [
    'quantidadeVenda' => 40,
    'desconto' => 5
];

$venda->setVenda($dataVenda);
$venda->getVenda();
var_dump($venda);
