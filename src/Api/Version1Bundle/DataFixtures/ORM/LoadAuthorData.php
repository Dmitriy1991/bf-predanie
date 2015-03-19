<?php

namespace Api\Version1Bundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Api\Version1Bundle\Entity\Author;

class LoadAuthorData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $aAuthors = array(
            array( 'name' => "Достоевский Федор Михайлович", 'description' => "Описание для автора", 'birthDate' => '1821-10-30' ),
            array( 'name' => "Алексей Константинович Толстой", 'description' => "Описание для автора", 'birthDate' => '1817-09-05' ),
            array( 'name' => "Александр Иванович Куприн", 'description' => "Описание для автора", 'birthDate' => '1870-09-07' ),
            array( 'name' => "Лев Николаевич Толстой", 'description' => "Описание для автора", 'birthDate' => '1828-09-09' ),
            array( 'name' => "Сергей Александрович Есенин", 'description' => "Описание для автора", 'birthDate' => '1895-10-03' ),
            array( 'name' => "Иван Сергеевич Тургенев", 'description' => "Описание для автора", 'birthDate' => '1818-11-09' ),
            array( 'name' => "Владимир Иванович Даль", 'description' => "Описание для автора", 'birthDate' => '1801-11-22' ),
            array( 'name' => "Афанасий Афанасьевич Фет", 'description' => "Описание для автора", 'birthDate' => '1820-12-05' ),
            array( 'name' => "Иван Андреевич Крылов", 'description' => "Описание для автора", 'birthDate' => '1769-02-13' ),
            array( 'name' => "Николай Васильевич Гоголь", 'description' => "Описание для автора", 'birthDate' => '1809-04-01' ),
            array( 'name' => "Александр Сергеевич Пушкин", 'description' => "Описание для автора", 'birthDate' => '1799-06-06' ),
            array( 'name' => "Анна Андреевна Ахматова", 'description' => "Описание для автора", 'birthDate' => '1889-06-23' ),
            array( 'name' => "Василий Макарович Шукшин", 'description' => "Описание для автора", 'birthDate' => '1929-07-25' ),
        );

        foreach ( $aAuthors as $aAuthor ) {
            $oAuthor = new Author();
            $oAuthor->setName( $aAuthor['name'] );
            $oAuthor->setDescription( $aAuthor['description'] );
            $oAuthor->setBirthDate( new \DateTime( $aAuthor['birthDate'] ) );

            $manager->persist($oAuthor);
        }

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        // the order in which fixtures will be loaded
        return 1;
    }
}