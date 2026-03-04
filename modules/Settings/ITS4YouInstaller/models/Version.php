<?php

class Settings_ITS4YouInstaller_Version_Model extends Vtiger_Base_Model
{
    protected $db;
    protected $extension;

    /**
     * @param array $values
     */
    public function __construct($values = array())
    {
        parent::__construct($values);

        $this->db = PearDatabase::getInstance();
    }

    /**
     * @param string $extension
     * @return Settings_ITS4YouInstaller_Version_Model
     * @throws Exception
     */
    public static function getInstance($extension)
    {
        $self = new self();
        $self->set('extension', $extension);
        $self->retrieveData();

        return $self;
    }

    /**
     * @throws Exception
     */
    public function retrieveData()
    {
        $result = $this->db->pquery('SELECT * FROM its4you_installer_version WHERE extension=?', [$this->get('extension')]);
        $data = $this->db->query_result_rowdata($result);

        foreach ($data as $key => $value) {
            $this->set($key, $value);
        }
    }

    public function save()
    {
        $data = [
            'extension' => $this->get('extension'),
            'version' => $this->get('version'),
            'update_datetime' => date('Y-m-d H:i:s'),
        ];

        if (!$this->isEmpty('versionid')) {
            $query = 'UPDATE its4you_installer_version SET extension=?, version=?, update_datetime=? WHERE versionid=?';
            $data['versionid'] = $this->get('versionid');
        } else {
            $query = 'INSERT INTO its4you_installer_version (extension, version, update_datetime) VALUES (?,?,?)';
        }

        $this->db->pquery($query, $data);
    }
}