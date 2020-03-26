<?php

namespace TheIconic\NameParser\Mapper;

use TheIconic\NameParser\Part\AbstractPart;
use TheIconic\NameParser\Part\Firstname;
use TheIconic\NameParser\Part\Lastname;
use TheIconic\NameParser\Part\Initial;
use TheIconic\NameParser\Part\Salutation;

class FirstnameMapper extends AbstractMapper
{

    /**
     * map firstnames in parts array
     *
     * @param array $parts the parts
     * @return array the mapped parts
     */
    public function map(array $parts) {
        if (count($parts) < 2) {
            if ($parts[0] instanceof AbstractPart) {
                return $parts;
            }

            $parts[0] = new Firstname($parts[0]);

            return $parts;
        }

        // skip to after salutation
        $length = count($parts);
        $start = 0;
        for ($i = 0; $i < $length; $i++) {
            if ($parts[$i] instanceof Salutation) {
                $start = $i + 1;
            }
        }

        $pos = null;

        for ($k = $start; $k < $length; $k++) {
            $part = $parts[$k];

            if ($part instanceof Lastname) {
                break;
            }

            if ($part instanceof Initial) {
                if (null === $pos) {
                    $pos = $k;
                }
            }

            if ($part instanceof AbstractPart) {
                continue;
            }

            $pos = $k;
            break;
        }

        if (null !== $pos) {
            $parts[$pos] = new Firstname($parts[$pos]);
        }

        return $parts;
    }

}
