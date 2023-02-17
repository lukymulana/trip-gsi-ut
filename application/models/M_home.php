<?php
class M_home extends CI_Model 
{
	function getData() {
        $this->db->select('*');
        $this->db->from('summary_trip');
        $this->db->join('data_cost', 'summary_trip.id_cost = data_cost.id_cost');
        $this->db->join('data_driver', 'summary_trip.id_driver = data_driver.id_driver');
        $this->db->order_by('date_trip', 'ASC');
        return $this->db->get()->result_array();
    }

    function getDriver() {
        return $this->db->get('data_driver')->result_array();
    }

    function getPointStart() {
        $this->db->select('point_start');
        $this->db->from('data_cost');
        $this->db->group_by('point_start');
        return $this->db->get()->result_array();
    }

    function getPointEnd($point_start) {
        $this->db->select('point_end');
        $this->db->from('data_cost');
        $this->db->where('point_start', $point_start);
        return $this->db->get()->result_array();
    }

    function getDataCost($point_start, $point_end) {
        $this->db->select('*');
        $this->db->from('data_cost');
        $this->db->where('point_start', $point_start);
        $this->db->where('point_end', $point_end);
        return $this->db->get()->result_array();
    }

    function addTrip($data) {
        $this->db->insert('summary_trip', $data);
        return $this->db->affected_rows();
    }

    function getTripById($id) {
        $this->db->select('*');
        $this->db->from('summary_trip');
        $this->db->join('data_cost', 'summary_trip.id_cost = data_cost.id_cost');
        $this->db->join('data_driver', 'summary_trip.id_driver = data_driver.id_driver');
        $this->db->where('id_trip', $id);
        return $this->db->get()->result_array();
    }

    function updateTrip($data, $id) {
        $this->db->where('id_trip', $id);
        $this->db->update('summary_trip', $data);
        return $this->db->affected_rows();
    }

    function deleteTrip($id) {
        $this->db->where('id_trip', $id);
        $this->db->delete('summary_trip');
        return $this->db->affected_rows();
    }
}
