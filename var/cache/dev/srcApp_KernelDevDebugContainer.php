<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\Container6FzjRwJ\srcApp_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/Container6FzjRwJ/srcApp_KernelDevDebugContainer.php') {
    touch(__DIR__.'/Container6FzjRwJ.legacy');

    return;
}

if (!\class_exists(srcApp_KernelDevDebugContainer::class, false)) {
    \class_alias(\Container6FzjRwJ\srcApp_KernelDevDebugContainer::class, srcApp_KernelDevDebugContainer::class, false);
}

return new \Container6FzjRwJ\srcApp_KernelDevDebugContainer([
    'container.build_hash' => '6FzjRwJ',
    'container.build_id' => 'd7be96b5',
    'container.build_time' => 1556356772,
], __DIR__.\DIRECTORY_SEPARATOR.'Container6FzjRwJ');
