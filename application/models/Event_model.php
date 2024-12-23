<?php
class Event_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database(); // Load the database library
    }


    public function save_event($data)
    {
        return $this->db->insert('events', $data);
    }

    public function get_all_events()
    {
        $this->db->where('status', '0');
        $query = $this->db->get('events');
        return $query->result_array();
    }

    public function get_event_by_id($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('events');
        return $query->result_array();
    }

    public function updateEvent($id, $updatedData)
    {
        $this->db->where('id', $id);
        $this->db->update('events', $updatedData);
        return $this->db->affected_rows() > 0;
    }


    public function delete_event($id, $updData)
    {
        $this->db->where('id', $id);
        $this->db->update('events', $updData);
        return $this->db->affected_rows() > 0;
    }
}
