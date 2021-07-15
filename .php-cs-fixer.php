
<?php
// see https://github.com/FriendsOfPHP/PHP-CS-Fixer

$finder = PhpCsFixer\Finder::create()
    ->in([__DIR__.'/src', __DIR__.'/tests'])
;

return (new PhpCsFixer\Config())
    ->setRiskyAllowed(true)
    ->setRules([
                   '@Symfony' => true,
                   '@Symfony:risky' => true,
                   'ordered_imports' => true,
                   'final_class' => true,
               ])
    ->setFinder($finder)
    ;
