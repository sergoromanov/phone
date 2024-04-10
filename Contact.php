<?php
class Contact {
    private $name;
    private $phone;

    public function __construct($name, $phone) {
        $this->name = $name;
        $this->phone = $phone;
    }

    public function getName() {
        return $this->name;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function toArray() {
        return [
            'name' => $this->name,
            'phone' => $this->phone
        ];
    }
}
?>
