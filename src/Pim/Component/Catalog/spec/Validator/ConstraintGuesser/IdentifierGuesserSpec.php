<?php

namespace spec\Pim\Component\Catalog\Validator\ConstraintGuesser;

use PhpSpec\ObjectBehavior;
use Pim\Component\Catalog\Model\AttributeInterface;

class IdentifierGuesserSpec extends ObjectBehavior
{
    function it_does_not_support_multiselect(AttributeInterface $attribute)
    {
        $attribute->getType()->willReturn('pim_catalog_multiselect');

        $this->supportAttribute($attribute)->shouldReturn(false);
    }

    function it_supports_identifier(AttributeInterface $attribute)
    {
        $attribute->getType()->willReturn('pim_catalog_identifier');

        $this->supportAttribute($attribute)->shouldReturn(true);
    }

    function it_guesses_constraints_on_identifier(AttributeInterface $attribute)
    {
        $this->guessConstraints($attribute)
            ->offsetGet(0)
            ->shouldReturnAnInstanceOf('Symfony\Component\Validator\Constraints\Regex');
    }
}
