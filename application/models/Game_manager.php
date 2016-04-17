<?php

/**
 * 
 */
class Game_manager extends CI_Model {
    
  // constructor
  function __construct() 
  {
      parent::__construct();
  }

  /* 
   * Creates and returns an array with information about the curretn game state.
   */
  function getGameState()
  {
    echo "Game State";

    $gameStateArray = array();
    $url = BSX . 'status';
    $gameState = simplexml_load_file($url);
    
    $gameStateArray['round'] = (string)$gameState->round;
    $gameStateArray['state'] = (int)$gameState->state;
    $gameStateArray['desc'] = (string)$gameState->desc;
    $gameStateArray['current'] = (string)$gameState->current;
    $gameStateArray['duration'] = (int)$gameState->duration;
    $gameStateArray['upcoming'] = (string)$gameState->upcoming;
    $gameStateArray['alarm'] = (string)$gameState->alarm;
    $gameStateArray['now'] = (string)$gameState->now;
    $gameStateArray['countdown'] = (int)$gameState->countdown;

    var_dump($gameStateArray);
    return $gameStateArray;
  }

  /*
   * Creates and returns an array of all the stock movements using data from 
   * the BSX server.
   */
  function getAllStockMovements()
  {
    $movementArray = array();
    $url = BSX . 'data/movement';
    $csvArray = self::ImportCSV2Array($url);

    if ($csvArray == NULL)
    {
      echo "There were no stoks on http://www.comp4711bsx.local/data/stocks";
      return NULL;
    }

    foreach($csvArray as $row)
    {
      $tempArray = array();
      $tempArray['seq'] = (int)$row['seq'];
      $tempArray['datetime'] = $row['datetime'];
      $tempArray['code'] = $row['code'];
      $tempArray['action'] = $row['action'];
      $tempArray['amount'] = (int)$row['amount'];
      
      array_push($movementArray, $tempArray);
    }
    return $movementArray; 
  }

  /*
   * Creates and returns an array of the 5 latest stock movements using data
   * from the BSX server.
   */
  function get5MostRecentMovements()
  {
    echo "Latest Movements";
    $lastestMovementArray = array();
    $movementArray = self::getAllStockMovements();
      
    if ($movementArray == NULL)
    {
      echo "There were no transactions on http://www.comp4711bsx.local/data/movement";
      return;
    }

    for ($i = count($movementArray) - 1; $i >= 0; $i--)
    {
      array_push($lastestMovementArray, $movementArray[$i]);
      if(count($lastestMovementArray) == 5)
      {
        break;
      }
    }
    
    var_dump($lastestMovementArray);
    return $lastestMovementArray;
  }

  /*
   * Creates and returns an array of all available stocks using data from the
   * BSX server.
   */
  function getAllStocks()
  {
    echo "Stocks";
    $stocksArray = array();
    $url = BSX . 'data/stocks';
    $csvArray = self::ImportCSV2Array($url);

    if ($csvArray == NULL)
    {
      return NULL;
    }

    foreach($csvArray as $row)
    {
      $tempArray = array();
      $tempArray['code'] = $row['code'];
      $tempArray['name'] = $row['name'];
      $tempArray['category'] = $row['category'];
      $tempArray['value'] = (int)$row['value'];
      
      array_push($stocksArray, $tempArray);
    }
    
    var_dump($stocksArray);
    return $stocksArray;
  }

  /*
   * Creates and returns an array of all the stock transactions using data from 
   * the BSX server.
   */
  function getAllStockTransactions()
  {
    $transactionArray = array();
    $url = BSX . 'data/transactions';
    $csvArray = self::ImportCSV2Array($url);

    if ($csvArray == NULL)
    {
      return NULL;
    }

    foreach($csvArray as $row)
    {
      $tempArray = array();
      $tempArray['seq'] = (int)$row['seq'];
      $tempArray['datetime'] = $row['datetime'];
      $tempArray['agent'] = $row['agent'];
      $tempArray['player'] = $row['player'];
      $tempArray['trans'] = $row['trans'];
      $tempArray['quantity'] = (int)$row['quantity'];
      
      array_push($transactionArray, $tempArray);
    }
    return $transactionArray;
  }

  /*
   * Creates and returns an array of the 5 latest stock transactions using data
   * from the BSX server.
   */
  function get5MostRecentTransactions()
  {
    echo "Latest Transactions";

    $lastestTransactionArray = array();
    $transactionArray = self::getAllStockTransactions();

    if ($transactionArray == NULL)
    {
      echo "There were no transactions on http://www.comp4711bsx.local/data/transactions";
      return;
    }

    for ($i = count($transactionArray) - 1; $i >= 0; $i--)
    {
      array_push($lastestTransactionArray, $transactionArray[$i]);
      if(count($lastestTransactionArray) == 5)
      {
        break;
      }
    }

    var_dump($lastestTransactionArray);
    return $lastestTransactionArray;
  }

  /* 
   * Converts CSV data into an associative array.
   * Taken from: http://timtrott.co.uk/php-function-import-csv-array/
   */
  function ImportCSV2Array($filename)
  {
      $row = 0;
      $col = 0;
      $results = array();
      $handle = @fopen($filename, "r");
      if ($handle) 
      {
          while (($row = fgetcsv($handle, 4096)) !== false) 
          {
              if (empty($fields)) 
              {
                  $fields = $row;
                  continue;
              }
   
              foreach ($row as $k=>$value) 
              {
                  $results[$col][$fields[$k]] = $value;
              }
              $col++;
              unset($row);
          }
          if (!feof($handle)) 
          {
              echo "Error: unexpected fgets() failn";
          }
          fclose($handle);
      }
      if (count($results) == 0)
      {
        return NULL;
      }
      return $results;
  }
  
}