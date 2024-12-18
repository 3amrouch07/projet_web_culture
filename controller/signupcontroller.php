<?php
    include 'config.php';
    include '../../model/signup.php';
    class signup
    {
        public function listesignup()
        {
            $sql="SELECT * FROM signup";
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
        function crypterNom($nom) {
            // Convertir le nom en minuscule et vérifier s'il correspond à "pata"
            if (strtolower($nom) === 'pata') {
                return '****'; // On remplace le nom par des astérisques
            }
            // Retourne le nom sécurisé avec htmlspecialchars
            return htmlspecialchars($nom);
        }
        public function getRoleStatistics() {
            $pdo = Config::getConnection();
            $query = $pdo->query("SELECT role, COUNT(*) as count FROM signup GROUP BY role");
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            
            // Transform result into an associative array like ['admin' => 10, 'client' => 50]
            $stats = [];
            foreach ($result as $row) {
                $stats[$row['role']] = $row['count'];
            }
            return $stats;
        }
        
        public function searchInscrit($term) {
            $pdo = Config::getConnection();
            $query = $pdo->prepare("
                SELECT * FROM signup 
                WHERE nom LIKE :term 
                OR prenom LIKE :term 
                OR email LIKE :term
            ");
            $query->execute(['term' => '%' . $term . '%']);
            return $query->fetchAll();
        }
        
        
        
        public function deletesignup($id)
        {
            $sql="DELETE FROM signup WHERE id = :id";
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
        public function addSignup($signup) {
            $db = config::getConnection(); 
            try {
                // Requête corrigée : utilisation de backticks autour de `date` et des autres noms de colonnes
                $query = $db->prepare(
                    "INSERT INTO signup (`Nom`, `Prenom`, `date`, `Email`, `Mot_de_passe`, `role`) 
                     VALUES (:Nom, :Prenom, :date, :Email, :Mot_de_passe, :role)"
                );
        
                // Formater la date au format Y-m-d
                $formattedDate = $signup->getDate()->format('Y-m-d');
        
                // Exécuter la requête SQL avec les paramètres
                $query->execute([
                    ':Nom' => $signup->getNom(),
                    ':Prenom' => $signup->getPrenom(),
                    ':date' => $formattedDate, 
                    ':Email' => $signup->getEmail(),
                    ':Mot_de_passe' => $signup->getMot_de_passe(), 
                    ':role' => $signup->getRole(),
                ]);
        
                echo "Registration successful!";
            } catch (PDOException $e) {
                // Ne pas afficher l'erreur SQL brute en production
                error_log("Error: " . $e->getMessage()); 
                echo "An error occurred. Please try again later.";
            }
        }
        
        public function updatesignup($signup, $id)
        {
            try
            {
                $db = config::getConnection();
                $query = $db->prepare(
                    "UPDATE signup SET 
                        Nom= :Nom,
                        Prenom= :Prenom,
                        date=:date,
                        Email= :Email,
                        Mot_de_passe= :Mot_de_passe,
                        role= :role
                    WHERE id=:id"
                );
                $query->execute([
                    'id'=>$id,
                    'Nom'=>$signup->getNom(),
                    'Prenom'=>$signup->getPrenom(),
                    'date'=>$signup->getdate(),
                    'Email'=>$signup->getEmail(),
                    'Mot_de_passe'=>$signup->getMot_de_passe(),
                    'role'=>$signup->getRole()
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
            $sql = "SELECT Email, Mot_de_passe, role  FROM signup WHERE Email = :Email";
            $db = config::getConnection();
            try {
                $con = $db->prepare($sql);
                $con->execute([':Email' => $Email]);
                $res = $con->fetch(PDO::FETCH_ASSOC);
                if ($res) {
                    echo "Email : " . htmlspecialchars($res['Email']) . "<br>";
                    echo "Password : " . htmlspecialchars($res['Mot_de_passe']) . "<br>";
                    echo "Role : " . htmlspecialchars($res['role']) . "<br>";
                    return $res['role'];
                   
                } else {
                    echo "Aucun utilisateur trouvé avec cet email.";
                    return null; 
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
                return null; 
            }
        }
        function showsignup($id)
        {
            $sql = "SELECT * from signup where id = $id";
            $db = config::getConnection();
            try {
                $query = $db->prepare($sql);
                $query->execute();

                $signup = $query->fetch();
                return $signup;
            } catch (Exception $e) {
                die('Error: ' . $e->getMessage());
            }
        }

        
    }
?>