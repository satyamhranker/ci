<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Event extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Event_model');
        $this->load->helper('url');
    }

    public function index()
    {
        $this->load->view('event_form');
    }

    public function save()
    {
        $response = array('status' => false, 'message' => 'An Error Occured');

        $date = $this->input->post('date');
        $title = $this->input->post('title');
        $description = $this->input->post('description');

        if ($date && $title && $description) {
            $data = array(
                'date' => $date,
                'title' => $title,
                'description' => $description,
            );

            if ($this->Event_model->save_event($data)) {
                $response = array('status' => true, 'message' => 'Event Saved Successfully');
            }
        } else {
            $response['message'] = 'All fields are required';
        }

        echo json_encode($response);
    }

    public function view()
    {
        $this->load->view('view_table');
    }

    public function get_events()
    {
        $this->load->model('Event_model');
        $events['events'] = $this->Event_model->get_all_events();
        $this->load->view('view_table', $events);
    }

    public function edit_events()
    {
        $id = $this->input->get('id');

        $this->load->model('Event_model');
        $data['event'] = $this->Event_model->get_event_by_id($id);
        $this->load->view('edit_event', $data);
    }
}
