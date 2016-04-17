<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GameManager extends Application 
{
  public function index()
  {
    // Everything here is just for testing. type http://comp4711.local:8080/gamemanager
    // so see what each function does
    $this->game_manager->getGameState();
    $this->game_manager->get5MostRecentMovements();
    $this->game_manager->getAllStocks();
    $this->game_manager->get5MostRecentTransactions();
    self::register();
    echo $this->bsx_tokens->getCurrentToken($this->game_manager->getGameState()['round']);
    // Stock code must be retrieved using the getAllStocks() function in game_manager model
    // since the codes change every round.
    self::buyStocks('Bob', 'TECH', 1);

    // Sell stocks using the data from the bsx_transactions MySql table (must create)
    self::sellStocks('Bob', 'TECH', 1, '92be4');

    // Clear bsx_transactions MySql table every round 
    //$this->bsx_transactions->emptyTransactionsTable();
  }

  /*
   * Agent registration, should be called when the game state is GAME_OPEN.
   * Parses the response from the server containing the current game round 
   * and the token that is used to buy and sell stocks. This data is stored in 
   * the bsx_tokens MYSql table (create it locally) with:
   * CREATE TABLE IF NOT EXISTS bsx_tokens
     (round DECIMAL(10) NOT NULL PRIMARY KEY
     ,token VARCHAR(50) NOT NULL);
   */
  public function register()
  {
    echo "Register function";
    $url = BSX . 'register';
    $data = array('team' => TEAM_CODE, 'name' => TEAM_NAME, 'password' => TEAM_PW);

    $options = array(
      'http' => array(
        'header' => "Content-type: application/x-www-form-urlencoded\r\n",
        'method' => 'POST',
        'content' => http_build_query($data)
      )
    );

    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $xml_team_token = simplexml_load_string($result);

    if ($result === FALSE)
    {
      echo "register post error";
    }
    else
    {
      var_dump($xml_team_token);
      
      $gameState = $this->game_manager->getGameState();
      if ($gameState['state'] ==  GAME_READY || $gameState['state'] ==  GAME_OPEN)
      {
        echo 'team: ' . $xml_team_token->team;
        echo '<br>';
        echo 'token: ' . $xml_team_token->token;
        $this->bsx_tokens->addToken($this->game_manager->getGameState()['round'], $xml_team_token->token);  
      }
      else
      {
        echo "Game state must be ready or open to register";
      }

    }
  }

  /*
   * Buy stocks function. Parses the response from the server containing the 
   * certificate, stock code, agent (O10), player name, amount bought and date.
   * this data is stored in the bsx_transcations MySql table. Need to create
   * table locally with:
   * CREATE TABLE IF NOT EXISTS bsx_transactions
     (token VARCHAR(50) NOT NULL PRIMARY KEY
     ,stock VARCHAR(10) NOT NULL
     ,agent VARCHAR(10) NOT NULL
     ,player VARCHAR(50) NOT NULL
     ,amount DECIMAL(10) NOT NULL
     ,datetime VARCHAR(50) NOT NULL);
   */
  public function buyStocks($playerName, $stock, $quantity)
  {
    echo "Buy stocks function";
    $token = $this->bsx_tokens->getCurrentToken($this->game_manager->getGameState()['round']);
    
    $url = BSX . 'buy';

    $data = array('team' => TEAM_CODE, 'token' => $token, 'player' => $playerName,
     'stock' => $stock, 'quantity' => $quantity);

    $options = array(
      'http' => array(
        'header' => "Content-type: application/x-www-form-urlencoded\r\n",
        'method' => 'POST',
        'content' => http_build_query($data)
      )
    );

    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $xml_certificate = simplexml_load_string($result);

    if ($result === FALSE)
    {
      echo "register post error";
    }
    else
    {
      var_dump($result);
      $this->bsx_transactions->addTransaction($xml_certificate->token,
                                              $xml_certificate->stock,
                                              $xml_certificate->agent,
                                              $xml_certificate->player,
                                              $xml_certificate->amount,
                                              $xml_certificate->datetime);
    }
  }

  /*
   * Sell stocks function. Wrong message being received fromm the server, Jim 
   * posted on D2L that selling may be broken.
   * The parameters for this function should be obtained from the bsx_transactions
   * table, I imagine there will be a drop down that allows players to select a 
   * stock to sell.
   * The row should be removed from the bsx_transactions table if transaction was
   * succesfully completed
   */
  public function sellStocks($playerName, $stock, $quantity, $certificate)
  {
    echo "Sell stocks function";
    $token = $this->bsx_tokens->getCurrentToken($this->game_manager->getGameState()['round']);
    
    $url = BSX . 'sell';

    // Remember to grab these values from the bsx_transactions table
    $data = array('team' => TEAM_CODE, 'token' => $token, 'player' => $playerName,
     'stock' => $stock, 'quantity' => $quantity, 'certificate' => $certificate);

    $options = array(
      'http' => array(
        'header' => "Content-type: application/x-www-form-urlencoded\r\n",
        'method' => 'POST',
        'content' => http_build_query($data)
      )
    );

    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    //$xml_certificate = simplexml_load_string($result);

    if ($result === FALSE)
    {
      echo "register post error";
    }
    else
    {
      var_dump($result);
      // Right now the reponse isn't correct im not sure if we should remove
      // this transaction from the table anyway
      // $this->bsx_transactions->delete($certificate);
    }
  }
}