<?php

namespace BoxConfig\BoxBundle\Twig;
use BoxConfig\AccountBundle\Entity\User;

class badgeExtension extends \Twig_Extension
{

    public function getFunctions()
    {
        return array(
            'badge_machine' => new \Twig_Function_Method($this, 'badgeMachine', array('is_safe' => array('html'))),
            'badge_software' => new \Twig_Function_Method($this, 'badgeSoftware', array('is_safe' => array('html'))),
        );
    }

    public function badgeMachine(User $user) {
        $count = count($user->getMachines());
        return $this->_createBadge($count);
    }

    public function badgeSoftware(User $user) {
        $count = 0;
        foreach ($user->getMachines() as $machine) {
            foreach ($machine->getEnvironments() as $environment) {
                $count += count($environment->getSoftware());
            }
        }
        return $this->_createBadge($count);
    }

    protected function _createBadge($count) {
        $type = ($count == 0) ? "badge-important" : "badge-info";
        return "<span class=\"badge ".$type."\">".$count."</span>";
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'badge';
    }
}