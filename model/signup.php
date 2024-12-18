<?php

class signupp
{
    private ?int $id;
    private ?string $Nom;
    private ?string $Prenom;
    private ?DateTime $date;
    private ?string $Email;
    private ?string $Mot_de_passe;
    private ?string $role;
    
    
public function __construct(?int $id, ?string $Nom, ?string $Prenom, ?DateTime $date, ?string $Email, ?string $Mot_de_passe, ?string $role) {
    $this->id=$id;
    $this->Nom=$Nom;
    $this->Prenom=$Prenom;
    $this->date=$date;
    $this->Email = $Email;
    $this->Mot_de_passe = $Mot_de_passe;
    $this->role = $role;
    
    
}
public function getId()  {
    return $this->id;
}

public function getNom()
{
    return $this->Nom;
}
public function getPrenom() 
{
    return $this->Prenom;
}

public function getDate() 
{
    return $this->date;
}
public function getEmail()
{
    return $this->Email;
}

public function getMot_de_passe()
{
    return $this->Mot_de_passe;
}

public function getRole()  {
    return $this->role;
}


public function setNom($Nom)
        {
            $this->Nom = $Nom;
        }

public function setPrenom($Prenom)
        {
            $this->Prenom = $Prenom;
        }

public function setDate($date)
        {
            $this->date = $date;
        }

public function setEmail($Email)
        {
            $this->Email = $Email;
        }
       
public function setMot_de_passe($Mot_de_passe)
        {
            $this->Mot_de_passe=$Mot_de_passe;
        }

public function setRole($role)
        {
            $this->role = $role;
        }


}




?>