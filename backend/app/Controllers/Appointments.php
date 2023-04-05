<?php
class Appointments extends Controller
{
    private $modelAppointment;

    public function __construct()
    {
        $this->modelAppointment = $this->model('Appointment');
    }


    public function addAppointment()
    {

        $data = json_decode(file_get_contents('php://input'));
        $this->modelAppointment->date_reservation = $data->date_reservation;
        $this->modelAppointment->heure_reservation = $data->heure_reservation;
        $this->modelAppointment->id_client = $data->id_client;
        if ($this->modelAppointment->addappointment()) {
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
        $results = $this->modelAppointment->readAppointments();
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
                    'heure_reservation' => $heure_reservation,
                    'id_client' => $id_client,
                );
                array_push($appointments['appointment'], $item);
            }
            echo json_encode($appointments);
        } else {
            echo json_encode(
                array('message' => 'NOT FOUND')
            );
        }
    }

    public function readSingleAppointment($id)
    {
        $this->modelAppointment->id_appointment = $id;
        $this->modelAppointment->readSingleAppiontment();
        $Appointment = array(
            'id_appointment' => $this->modelAppointment->id_appointment,
            'date_reservation' => $this->modelAppointment->date_reservation,
            'heure_reservation' => $this->modelAppointment->heure_reservation,
            'first_name_client' => $this->modelAppointment->first_name_client,
            'last_name_client' => $this->modelAppointment->last_name_client,
        );
        print_r(json_encode($Appointment));
    }

    public function updateAppointment($id)
    {

        $data = json_decode(file_get_contents('php://input'));
        $this->modelAppointment->date_reservation = $data->date_reservation;
        $this->modelAppointment->heure_reservation = $data->heure_reservation;
        // $this->modelAppointment->id_client = $data->id_client;

        if ($this->modelAppointment->updateAppointment()) {
            echo json_encode(
                array('message' => 'appointment updated')
            );
        } else {
            echo json_encode(
                array('message' => 'Error')
            );
        }
    }

    public function deleteAppointment()
    {
        $data = json_decode(file_get_contents('php://input'));
        $this->modelAppointment->id_client =  $data->client_id;
        $this->modelAppointment->date_reservation = $data->date_reservation;
        $this->modelAppointment->heure_reservation = $data->heure_reservation;
        if ($this->modelAppointment->deleteAppointment()) {
            echo json_encode(
                array('message' => 'appointment deleted',)
            );
        } else {
            echo json_encode(
                array('message' => 'Error')
            );
        }
    }

    public function checkByDate($date)
    {
        $this->modelAppointment->date_reservation = $date;
        $results = $this->modelAppointment->checkDate();
        echo json_encode($results);
    }
    public function userAppointement($id){
        $this->modelAppointment->id_client = $id;
        $results=$this->modelAppointment->userAppointement();
        echo json_encode($results);
    }
}
