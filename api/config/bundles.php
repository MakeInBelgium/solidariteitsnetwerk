<?php

return [
    Symfony\Bundle\FrameworkBundle\FrameworkBundle::class => ['all' => true],
    Symfony\Bundle\SecurityBundle\SecurityBundle::class => ['all' => true],
    Symfony\Bundle\MercureBundle\MercureBundle::class => ['all' => true],
    Symfony\Bundle\TwigBundle\TwigBundle::class => ['all' => true],
    Doctrine\Bundle\DoctrineBundle\DoctrineBundle::class => ['all' => true],
    ApiPlatform\Core\Bridge\Symfony\Bundle\ApiPlatformBundle::class => ['all' => true],
    Nelmio\CorsBundle\NelmioCorsBundle::class => ['all' => true],
    Symfony\Bundle\WebProfilerBundle\WebProfilerBundle::class => ['dev' => true, 'test' => true],
    Symfony\Bundle\MakerBundle\MakerBundle::class => ['dev' => true],
    Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle::class => ['all' => true],
    Fidry\AliceDataFixtures\Bridge\Symfony\FidryAliceDataFixturesBundle::class => ['all' => true, 'dev' => true, 'test' => true],
    Hautelook\AliceBundle\HautelookAliceBundle::class => ['all' => true, 'dev' => true, 'test' => true],
    Danaki\DoctrineEnumTypeBundle\DanakiDoctrineEnumTypeBundle::class => ['all' => true],
    Lexik\Bundle\JWTAuthenticationBundle\LexikJWTAuthenticationBundle::class => ['all' => true],
    Vich\UploaderBundle\VichUploaderBundle::class => ['all' => true],
    // EasyCorp\Bundle\EasyAdminBundle\EasyAdminBundle::class => ['all' => true],
    Krak\EnumNormalizer\Bridge\Symfony\EnumNormalizerBundle::class => ['all' => true],
    Symfony\Bundle\MonologBundle\MonologBundle::class => ['all' => true],
    Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle::class => ['all' => true, 'dev' => true, 'test' => true],
    Nelmio\Alice\Bridge\Symfony\NelmioAliceBundle::class => ['all' => true, 'dev' => true, 'test' => true],
    JK\MoneyBundle\JKMoneyBundle::class => ['all' => true],
    League\FlysystemBundle\FlysystemBundle::class => ['all' => true],
    Liip\ImagineBundle\LiipImagineBundle::class => ['all' => true],
    Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle::class => ['all' => true],
];
