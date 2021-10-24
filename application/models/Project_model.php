<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Project_model extends CI_Model
{

    protected $select;

    public function __construct()
    {
        parent::__construct();
        $this->select = array(
            'projects.id',
            'projects.name',
            'projects.abbr',
            'projects.path_logo',
        );
    }

    public function get_all_data()
    {
        $this->db->select($this->select);
        $this->db->from('projects');
        $this->db->where('projects.deleted_at', null);
        $this->db->order_by('projects.id', 'asc');
        $exec = $this->db->get();

        $result = array();

        if ($exec->num_rows() == 0) {
            $result[0] = array(
                'no'        => 1,
                'name'      => '',
                'abbr'      => '',
                'path_logo' => base_url() . 'assets/img/default-150x150.png',
            );
        } else {
            $itteration = 1;
            foreach ($exec->result() as $key) {
                $nested['no']        = $itteration++;
                $nested['name']      = $key->name;
                $nested['abbr']      = $key->abbr;
                if ($key->path_logo != null || $key->path_logo != '') {
                    $nested['path_logo'] = base_url() . 'assets/img/projects/' . $key->path_logo;
                } else {
                    $nested['path_logo'] = base_url() . 'assets/img/default-150x150.png';
                }
                array_push($result, $nested);
            }
        }

        return $result;
    }

    public function get_single_data($keyword)
    {
        $this->db->select($this->select);
        $this->db->from('projects');
        $this->db->where('projects.abbr', $keyword);
        $this->db->where('projects.deleted_at', null);
        $this->db->order_by('projects.id', 'asc');
        $exec = $this->db->get();

        if ($exec->num_rows() == 0) {
            $result['name'] = 'Pekgo Group';
            $result['logo'] = base_url() . 'assets/img/AdminLTELogo.png';
        } else {
            $result['name'] = $exec->row()->name;
            $result['logo'] = base_url() . 'assets/img/projects/' . $exec->row()->path_logo;
        }

        return $result;
    }


    public function store($data)
    {
        return $this->db->insert('projects', $data);
    }
}
                        
/* End of file Project_model.php */
