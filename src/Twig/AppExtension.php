<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension {

    public function getFilters () {
        return array(
                new TwigFilter('record_status', array($this, 'booleanFilter')),
                new TwigFilter('parse_role', array($this, 'roleFilter')),
        );
    }
    
    public function booleanFilter($flag) {
        if (is_null($flag) || $flag != 1) {
            return 'Inactivo';
        }
        return 'Activo';
    }
    
    public function roleFilter($roleName) {
        if ($roleName == 'ROLE_ADMIN') {
            return 'label.user.role.admin';            
        }
        return 'label.user.role.user';
    }
}

