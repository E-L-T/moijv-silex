<?php

namespace DAO;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Entity\User;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;

/**
 * Description of UserDAO
 *
 * @author eric
 */
class UserDAO extends \SimpleDAO\DAO implements UserProviderInterface
{

    //put your code here
    public function loadUserByUsername($username)
    {
        //select * from user where username = ? LIMIT 1 (et le résultat est converti en entité)
        // bindvalue(1, $username)
        $user = $this->findOne(array('username = ?' => $username)); //findOne est une méthode fournie par simpledao
            if (! $user) {
                throw new UsernameNotFoundException("User with username $username does not exist");
            }
            return $user;
    }

    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', get_class($user)));
        }

        return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass($class)
    { // pour confirmation
        return $class === '\Entity\User';
    }

}
