<?php

namespace TheIconic\NameParser;

use TheIconic\NameParser\Mapper\NicknameMapper;
use TheIconic\NameParser\Mapper\SalutationMapper;
use TheIconic\NameParser\Mapper\SuffixMapper;
use TheIconic\NameParser\Mapper\InitialMapper;
use TheIconic\NameParser\Mapper\LastnameMapper;
use TheIconic\NameParser\Mapper\FirstnameMapper;
use TheIconic\NameParser\Mapper\MiddlenameMapper;

class Parser
{

    protected $whitespace = " \r\n\t";

    protected $mappers = [];

    /**
     * split full names into the following parts:
     * - prefix / salutation  (Mr., Mrs., etc)
     * - given name / first name
     * - middle initials
     * - surname / last name
     * - suffix (II, Phd, Jr, etc)
     *
     * @param $full_name
     * @return Name
     */
    public function parse($name) {

        $name = $this->normalize($name);

        if (false !== $pos = strpos($name, ',')) {
            return $this->parseSplitName(substr($name, 0, $pos), substr($name, $pos + 1));
        }

        $parts = explode(' ', $name);

        foreach ($this->getMappers() as $mapper) {
            $parts = $mapper->map($parts);
        }

        return new Name($parts);
    }

    /**
     * handles split-parsing of comma-separated name parts
     *
     * @param $left - the name part left of the comma
     * @param $right - the name part right of the comma
     *
     * @return Name
     */
    protected function parseSplitName($left, $right) {
        $first = new Parser();
        $first->setMappers([
            new SalutationMapper(),
            new SuffixMapper(),
            new LastnameMapper(['match_single' => true]),
        ]);
        $second = new Parser();
        $second->setMappers([
            new NicknameMapper(),
            new InitialMapper(),
            new FirstnameMapper(),
            new MiddlenameMapper(),
        ]);
        $parts = array_merge(
            $first->parse($left)->getParts(),
            $second->parse($right)->getParts()
        );
        return new Name($parts);
    }

    /**
     * get the mappers for this parser
     *
     * @return array
     */
    public function getMappers()
    {
        if (empty($this->mappers)) {
            $this->setMappers([
                new NicknameMapper(),
                new SalutationMapper(),
                new SuffixMapper(),
                new InitialMapper(),
                new LastnameMapper(),
                new FirstnameMapper(),
                new MiddlenameMapper(),
            ]);
        }

        return $this->mappers;
    }

    /**
     * set the mappers for this parser
     *
     * @param array $mappers
     */
    public function setMappers(array $mappers)
    {
        $this->mappers = $mappers;
    }

    /**
     * normalize the name
     *
     * @param $name
     * @return mixed
     */
    protected function normalize($name)
    {
        $whitespace = $this->getWhitespace();

        $name = trim($name);

        return preg_replace('/[' . preg_quote($whitespace) . ']+/', ' ', $name);
    }

    /**
     * get a string of characters that are supposed to be treated as whitespace
     *
     * @return string
     */
    protected function getWhitespace()
    {
        return $this->whitespace;
    }

    /**
     * set the string of characters that are supposed to be treated as whitespace
     *
     * @param $whitespace
     */
    protected function setWhitespace($whitespace)
    {
        $this->whitespace = $whitespace;
    }

}
