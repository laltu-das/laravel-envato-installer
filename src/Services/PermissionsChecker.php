<?php

namespace Laltu\LaravelEnvato\Services;

class PermissionsChecker
{
    /**
     * @var array
     */
    protected array $results = [];

    /**
     * Set the result array permissions and errors.
     *
     * @return void
     */
    public function __construct()
    {
        $this->results['permissions'] = [];

        $this->results['errors'] = null;
    }

    /**
     * Check for the folders permissions.
     *
     * @param  array  $folders
     * @return array
     */
    public function check(array $folders): array
    {
        foreach ($folders as $folder => $permission) {
            if (! ($this->getPermission($folder) >= $permission)) {
                $this->addFileAndSetErrors($folder, $permission, false);
            } else {
                $this->addFile($folder, $permission, true);
            }
        }

        return $this->results;
    }

    /**
     * Get a folder permission.
     *
     * @param  $folder
     * @return string
     */
    private function getPermission($folder): string
    {
        return substr(sprintf('%o', fileperms(base_path($folder))), -4);
    }

    /**
     * Add the file to the list of results.
     *
     * @param  $folder
     * @param  $permission
     * @param  $isSet
     */
    private function addFile($folder, $permission, $isSet): void
    {
        $this->results['permissions'][] = [
            'folder' => $folder,
            'permission' => $permission,
            'isWritable' => $isSet,
        ];
    }

    /**
     * Add the file and set the errors.
     *
     * @param  $folder
     * @param  $permission
     * @param  $isSet
     */
    private function addFileAndSetErrors($folder, $permission, $isSet): void
    {
        $this->addFile($folder, $permission, $isSet);

        $this->results['errors'] = true;
    }
}
