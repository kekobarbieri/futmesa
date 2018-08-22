<?php
/**
 * Projeto FutMesaBackEnd
 *
 * @copyright : Renato Martins Barbieri Nunes
 * @version 0.1
 */
namespace DAO;

require_once "DataAccessObjects/Championship/DaoChampionshipInterface.php";
require_once "DataAccessObjects/XMLInterface.php";
require_once "ValueObjects/Championship.php";

/**
 * Objeto para acessar o banco de dados de testes dos campeonatos.
 */
class DaoTestChampionship implements DaoChampionshipInterface
{
   const PATH = "DataAccessObjects\\Championship\\Mock\\CHAMPIONSHIP.xml";

   /**
    *
    * {@inheritdoc}
    * @see \DAO\DaoChampionshipInterface::getAllChampionships()
    */
   public function getAllChampionships(): array
   {
      $championships = array ();
      $database = new XMLInterface( self::PATH );
      $result = $database->getAllObjects( self::CHAMPIONSHIP );

      foreach ( $result as &$item )
      {
         $championships[] = $this->convertToChampionship( $item );
      }

      return $championships;
   }

   /**
    *
    * {@inheritdoc}
    * @see DaoTableObjectInterface::insertTableObjects()
    */
   // public function insertTableObjects( array $objects ): bool
   // {
   // $database = new XMLInterface( self::PATH );
   // $result = true;
   // $input = array ();
   // $input[ self::ID ] = null;

   // foreach( $objects as &$objVO )
   // {
   // $input[ self::NAME ] = $objVO->name;
   // $input[ self::DESCRIPTION ] = $objVO->description;
   // $result &= ( $database->insertItem( $input ) > 0 );
   // }

   // return $result;
   // }

   /**
    *
    * {@inheritdoc}
    * @see DaoTableObjectInterface::updateTableObjects()
    */
   // public function updateTableObjects( array $objects ): bool
   // {
   // $database = new XMLInterface( self::PATH );
   // $result = true;

   // foreach( $objects as &$objVO )
   // {
   // $filter = array ();
   // $filter[ self::ID ] = $objVO->idasset;
   // $input = array ();
   // $input[ self::NAME ] = $objVO->name;
   // $input[ self::DESCRIPTION ] = $objVO->description;
   // $result &= $database->updateFile( $filter, $input );
   // }

   // return $result;
   // }

   /**
    *
    * {@inheritdoc}
    * @see DaoTableObjectInterface::deleteTableObjects()
    */
   // public function deleteTableObjects( array $ids ): bool
   // {
   // $database = new XMLInterface( self::PATH );
   // $result = true;

   // foreach( $ids as $id )
   // {
   // $filter = array ();
   // $filter[ self::ID ] = $id;
   // $result &= $database->removeItems( $filter );
   // }

   // return $result;
   // }

   /**
    * Converte o resultado do banco de dados em um campeonato.
    *
    * @param array $result
    *           Mapa de resultados do banco para um campeonato.
    * @return \ValueObject\Championship Campeonato.
    */
   private function convertToChampionship( array $result ): \ValueObject\Championship
   {
      $object = new \ValueObject\Championship();
      $object->id = $result[ self::ID ];
      $object->name = $result[ self::NAME ];
      $object->basedate = $result[ self::BASEDATE ];
      $object->dateincr = $result[ self::DATEINCR ];
      $object->roundsbyday = $result[ self::ROUNDSBYDAY ];
      $object->gamesbyround = $result[ self::GAMESBYROUND ];
      return $object;
   }
}
?>
