<?php
    include 'config.php';
    include '../../model/signupart.php';
    class signupart
    {
        public function listesignupart()
        {
            $sql="SELECT * FROM signupart";
            $db=config::getConnection();
            try
            {
                $liste=$db->query($sql);
                return $liste;
            }
            catch(PDOException $e)
            {
                die("Error: ".$e->getMessage());
            }
        }
        
        public function deletesignupart($id)
        {
            $sql="DELETE FROM signupart WHERE id = :id";
            $db=config::getConnection();
            $req=$db->prepare($sql);
            $req->bindValue(':id',$id);
            try
            {
                $req->execute();
            }
            catch(Exception $e)
            {
                die("Error: ".$e->getMessage());
            }
        }
        public function addsignupart($signupart) {
            $db = config::getConnection(); 
            try {
                $query = $db->prepare(
                    "INSERT INTO signupart (Nom, Prenom, date, Numero, Email, Mot_de_passe) 
                     VALUES (:Nom, :Prenom, :date, :Numero, :Email, :Mot_de_passe)"
                );
        
                // Format the DateTime object to a string
                $formattedDate = $signupart->getDate()->format('Y-m-d');
        
                $query->execute([
                    ':Nom' => $signupart->getNom(),
                    ':Prenom' => $signupart->getPrenom(),
                    ':date' => $formattedDate, // Use formatted date here
                    ':Numero' => $signupart->getNumero(),
                    ':Email' => $signupart->getEmail(),
                    ':Mot_de_passe' => $signupart->getMot_de_passe(),
                ]);
        
                echo "Registration successful!";
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage(); 
            }
        }
        
        

        
        public function updatesignupart($signupart, $id)
        {
            try
            {
                $db = config::getConnection();
                $query = $db->prepare(
                    "UPDATE signupart SET 
                        Nom= :Nom,
                        Prenom= :Prenom,
                        date= :date,
                        Numero= :Numero,
                        Email= :Email,
                        Mot_de_passe= :Mot_de_passe
                    WHERE id=:id"
                );
                $query->execute([
                    'id'=>$id,
                    'Nom' => $signupart->getNom(),
                    'Prenom' => $signupart->getPrenom(),
                    'date' => $signupart->getdate(),
                    'Numero'=>$signupart->getNumero(),
                    'Email' => $signupart->getEmail(),
                    'Mot_de_passe' => $signupart->getMot_de_passe()
                ]);
                echo $query->rowCount()."records UPDATED successfully <br>";
            }
            catch(PDOException $e)
            {
                echo "Error: ".$e->getMessage();
            }
        }

        public function connecter($Email)
        {
            $sql = "SELECT Email, Mot_de_passe  FROM signupart WHERE Email = :Email";
            $db = config::getConnection();
            try {
                $con = $db->prepare($sql);
                $con->execute([':Email' => $Email]);
                $res = $con->fetch(PDO::FETCH_ASSOC);
                if ($res) {
                    echo "Email : " . htmlspecialchars($res['Email']) . "<br>";
                    echo "Password : " . htmlspecialchars($res['Mot_de_passe']) . "<br>";
                    return $res['Email'];
                   
                } else {
                    echo "Aucun utilisateur trouvé avec cet email.";
                    return null; 
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
                return null; 
            }
        }
        function showsignupart($id)
        {
            $sql = "SELECT * from signupart where id = $id";
            $db = config::getConnection();
            try {
                $query = $db->prepare($sql);
                $query->execute();

                $signupart = $query->fetch();
                return $signupart;
            } catch (Exception $e) {
                die('Error: ' . $e->getMessage());
            }
        }

        
    }
?>