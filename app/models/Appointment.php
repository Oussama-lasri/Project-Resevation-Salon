<?php 
class Appointment {
    public $id_appointment;
    public $date_reservation;
    public $heure_reservation;
    public $id_client;
    public $first_name_client;
    public $last_name_client;

    private $table = 'appointment';
    private $conn;

    public function __construct(){
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function addappointment(){
        $query = 'INSERT INTO ' . $this->table . ' SET date_reservation = :date_reservation ,
                                                    heure_reservation = :heure_reservation,
                                                    id_client = :id_client
                                                    ';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':date_reservation',$this->date_reservation);
        $stmt->bindParam(':heure_reservation',$this->heure_reservation);
        $stmt->bindParam(':id_client',$this->id_client);

        if($stmt->execute()){
            return true;
        }else{
            return false;
        }                                      
    }

    public function readAppointments(){
        $query ='SELECT * FROM ' .$this->table ;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        // $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // die(var_dump($stmt));    
        return $stmt;
    }


    public function readSingleAppintment(){
        $query = 'SELECT 
        ap.id_appointment ,
        ap.date_reservation,
        ap.heure_reservation,
        u.first_name,
        u.last_name 
        FROM ' . $this->table . ' ap left join user u ON u.id_user = ap.id_client  
        WHERE ap.id_appointment = :id
        LIMIT 0,1 ';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id_appointment);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->id_appointment = $row['id_appointment'];
        $this->date_reservation = $row['date_reservation'];
        $this->heure_reservation = $row['heure_reservation'];
        $this->first_name_client = $row['first_name_client'];
        $this->last_name_client = $row['last_name_client'];
    }



    public function updateAppointment(){
        $query = 'UPDATE ' . $this->table . ' SET date_reservation = :date_reservation ,
        heure_reservation = :heure_reservation
        WHERE
        id_client = :id_client ';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':date_reservation',$this->date_reservation);
        $stmt->bindParam(':heure_reservation',$this->heure_reservation);
        $stmt->bindParam(':id_client',$this->id_client);

        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
}