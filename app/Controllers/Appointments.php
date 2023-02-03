<?php
class Appointments extends Controller
{
    private $modelRendezVous;

    public function __construct()
    {
        $this->modelRendezVous = $this->model('Appointment');
    }


    public function addAppointment()
    {
        $this->modelRendezVous->date_reservation = '2022-2-12';
        $this->modelRendezVous->heure_reservation = '8:00';
        $this->modelRendezVous->id_client = 16;
        if ($this->modelRendezVous->addappointment()) {
            echo json_encode(
                array('message' => 'Appointment Created')
            );
        } else {
            echo json_encode(
                array('message' => 'Appointment not Created')
            );
        }
    }

    public function readAppointments()
    {
        $results = $this->modelRendezVous->readAppointments();
        // die(var_dump($appointments->fetchAll(PDO::FETCH_ASSOC)));
        $count = $results->rowCount();
        // echo $results->rowCount();results
        if ($count > 1) {
            $appointments = array();
            $appointments['appointment'] = array();
            while ($row = $results->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $item = array(
                    'id_appointment' => $id_appointment,
                    'date_reservation' => $date_reservation,
                    'heure_reservation' => $date_reservation,
                    'id_client' => $date_reservation,
                );
                array_push($appointments['appointment'], $item);
            }

            echo json_encode($appointments);
           
        }else{
            echo json_encode(
                array('message' => 'NOT FOUND')
            );
        }
    }
}
