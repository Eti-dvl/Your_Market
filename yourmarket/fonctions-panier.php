<?php session_start(); 
	

?>



<?php

	if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['id'])){	
		$id=$_POST['id'];
		supprimerArticle($id);
	}
	

	/**
	 * Verifie si le panier existe, le crée sinon
	 * @return booleen
	 */
	function creationPanier(){
	   if (!isset($_SESSION['panier'])){
		  $_SESSION['panier']=array();
		  $_SESSION['panier']['id'] = array();
		  $_SESSION['panier']['qteProduit'] = array();
		  $_SESSION['panier']['prixProduit'] = array();
		  $_SESSION['panier']['verrou'] = false;
	   }
	   return true;
	}


	/**
	 * Ajoute un article dans le panier
	 * @param string $id
	 * @param int $qteProduit
	 * @param float $prixProduit
	 * @return void
	 */
	function ajouterArticle($id,$qteProduit,$prixProduit){

	   //Si le panier existe
	   if (creationPanier() && !isVerrouille())
	   {
		  //Si le produit existe déjà on ajoute seulement la quantité
		  $positionProduit = array_search($id,  $_SESSION['panier']['id']);

		  if ($positionProduit !== false)
		  {
			 $_SESSION['panier']['qteProduit'][$positionProduit] += $qteProduit ;
		  }
		  else
		  {
			 //Sinon on ajoute le produit
			 array_push( $_SESSION['panier']['id'],$id);
			 array_push( $_SESSION['panier']['qteProduit'],$qteProduit);
			 array_push( $_SESSION['panier']['prixProduit'],$prixProduit);
		  }
	   }
	   else
	   echo "Error 666 please contact the satan.";
	}



	/**
	 * Modifie la quantité d'un article
	 * @param $id
	 * @param $qteProduit
	 * @return void
	 */
	function modifierQTeArticle($id,$qteProduit){
	   //Si le panier existe
	   if (creationPanier() && !isVerrouille())
	   {
		  //Si la quantité est positive on modifie sinon on supprime l'article
		  if ($qteProduit > 0)
		  {
			 //Recharche du produit dans le panier
			 $positionProduit = array_search($id,  $_SESSION['panier']['id']);

			 if ($positionProduit !== false)
			 {
				$_SESSION['panier']['qteProduit'][$positionProduit] = $qteProduit ;
			 }
		  }
		  else
		  supprimerArticle($id);
	   }
	   else
	   echo "Error 666 please contact the satan.";
	}

	/**
	 * Supprime un article du panier
	 * @param $id
	 * @return unknown_type
	 */
	function supprimerArticle($id){
	    //Si le panier existe
		
		if (creationPanier() && !isVerrouille())
		{
			//Nous allons passer par un panier temporaire
			$tmp=array();
			$tmp['id'] = array();
			$tmp['qteProduit'] = array();
			$tmp['prixProduit'] = array();
			$tmp['verrou'] = $_SESSION['panier']['verrou'];
			
			for($i = 0; $i < count($_SESSION['panier']['id']); $i++)
			{
				
				if ($_SESSION['panier']['id'][$i] !== $id)
				{
					
					array_push( $tmp['id'],$_SESSION['panier']['id'][$i]);
					array_push( $tmp['qteProduit'],$_SESSION['panier']['qteProduit'][$i]);
					array_push( $tmp['prixProduit'],$_SESSION['panier']['prixProduit'][$i]);
				}

			}
			//On remplace le panier en session par notre panier temporaire à jour
			$_SESSION['panier'] =  $tmp;
			//On efface notre panier temporaire
			unset($tmp);
			
			for($i = 0; $i < count($_SESSION['panier']); $i++)
			{
			}
			
		}
		   else
		   echo "Error 666 please contact the satan.";
	}


	/**
	 * Montant total du panier
	 * @return int
	 */
	function MontantGlobal(){
	   $total=0;
	   for($i = 0; $i < count($_SESSION['panier']['id']); $i++)
	   {
		  $total += $_SESSION['panier']['qteProduit'][$i] * $_SESSION['panier']['prixProduit'][$i];
	   }
	   return $total;
	}


	/**
	 * Fonction de suppression du panier
	 * @return void
	 */
	function supprimePanier(){
	   unset($_SESSION['panier']);
	}

	/**
	 * Permet de savoir si le panier est verrouillé
	 * @return booleen
	 */
	function isVerrouille(){
	   if (isset($_SESSION['panier']) && $_SESSION['panier']['verrou'])
	   return true;
	   else
	   return false;
	}

	/**
	 * Compte le nombre d'articles différents dans le panier
	 * @return int
	 */
	function compterArticles()
	{
	   if (isset($_SESSION['panier']))
	   return count($_SESSION['panier']['id']);
	   else
	   return 0;

	}
	


?>