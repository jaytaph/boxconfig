<?php

namespace BoxConfig\DefaultBundle\Hydrators;

use Doctrine\ORM\Internal\Hydration\ObjectHydrator;

/**
* This hydrator fetches all scalar results that might have been added and actually
* adds them to the entity. This makes it easier to process scalar results in our
* twig templates (we can use talk.scalarResult instead of difficult ways).
*
* There is probably a better way to deal with this, but I haven't found it yet.
*/


class ScalarObjectHydrator extends ObjectHydrator
{
    protected function _hydrateRow(array $row, array &$cache, array &$result)
    {
        // Hydrate as usual
        parent::_hydrateRow($row, $cache, $result);

        /*
* Results look like this:
*
* arrayCollection`(
* array($entity, $scalar, $scalar, $scalar, ...),
* array($entity, $scalar, $scalar, $scalar, ...),
* );
*/


        // Now process the result
        foreach ($result as $item_key => $item) {
            // This result does not look like a hybrid entity/scalar. Ignore
            if (! is_array($item)) continue;

            // We assume (correctly?) that the firs item is always the entity
            $entity = array_shift($item);

            foreach ($item as $k => $v) {
                // scalar result "foo" because $entity->scalarFoo
                $s = "scalar".ucfirst(strtolower($k));
                $entity->{$s} = $v;
            }

            // Only return the entity
            $result[$item_key] = $entity;
        }

    }

}