<?php

use Doctrine\Common\ClassLoader,
    Doctrine\ORM\Tools\Setup,
    Doctrine\ORM\Configuration,
    Doctrine\ORM\EntityManager,
    Doctrine\Common\Cache\ArrayCache,
    Doctrine\DBAL\Logging\EchoSQLLogger,
    Doctrine\ORM\Tools\EntityGenerator;

class Doctrine {

    /**
     *
     * @var EntityManager 
     */
    public $em = null;

    public function __construct() {
        // load database configuration from CodeIgniter
        require_once APPPATH . 'config/database.php';

        // Set up class loading. You could use different autoloaders, provided by your favorite framework,
        // if you want to.
        require_once APPPATH . 'libraries/Doctrine/Common/ClassLoader.php';

        $doctrineClassLoader = new ClassLoader('Doctrine', APPPATH . 'libraries');
        $doctrineClassLoader->register();
        //loading models with Entities namespace
        $entitiesClassLoader = new ClassLoader('Entities', APPPATH . "models");
        $entitiesClassLoader->register();
        
        //loading models under model path
        spl_autoload_register(array($this, 'loadModel'));

        // Set up caches
        $config = new Configuration;
        $cache = new ArrayCache;
        $config->setMetadataCacheImpl($cache);
        $driverImpl = $config->newDefaultAnnotationDriver(array(APPPATH . 'models/Entities'));
        $config->setMetadataDriverImpl($driverImpl);
        $config->setQueryCacheImpl($cache);

        // Proxy configuration
        $config->setProxyDir(APPPATH . '/models/Proxies');
        $config->setProxyNamespace('Proxies');

        // Set up logger
//        $logger = new EchoSQLLogger;
//        $config->setSQLLogger($logger);

        $config->setAutoGenerateProxyClasses(TRUE);

        // Database connection information
        $connectionOptions = array(
            'driver' => 'pdo_mysql',
            'user' => $db['default']['username'],
            'password' => $db['default']['password'],
            'host' => $db['default']['hostname'],
            'dbname' => $db['default']['database']
        );

        // Create EntityManager
        $this->em = EntityManager::create($connectionOptions, $config);
    }

    public function loadModel($className){
        if(file_exists(APPPATH . 'models'.DIRECTORY_SEPARATOR.$className.'.php'))
            require APPPATH . 'models'.DIRECTORY_SEPARATOR.$className.'.php';
        elseif(file_exists(APPPATH . 'forms'.DIRECTORY_SEPARATOR.$className.'.php'))
                require APPPATH . 'forms'.DIRECTORY_SEPARATOR.$className.'.php';
        return true;
    }
    
    public function generateEntities() {

// custom datatypes (not mapped for reverse engineering)
        $this->em->getConnection()->getDatabasePlatform()->registerDoctrineTypeMapping('set', 'string');
        $this->em->getConnection()->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');

// fetch metadata
        $driver = new \Doctrine\ORM\Mapping\Driver\DatabaseDriver(
                        $this->em->getConnection()->getSchemaManager()
        );
        $driver->setNamespace('Entities\\');
        $this->em->getConfiguration()->setMetadataDriverImpl($driver);
        $cmf = new \Doctrine\ORM\Tools\DisconnectedClassMetadataFactory($this->em);

        $cmf->setEntityManager($this->em);

        $metadata = $cmf->getAllMetadata();

        $objs = array();

        /* @var $meta  \Doctrine\ORM\Mapping\ClassMetadata */
        foreach ($metadata as $key => $meta) {
            $objs[$meta->name] = $meta;
        }
        $metadata = $objs;
        $mapping = array();

        foreach ($metadata as $key => $meta) {
            if ($meta->associationMappings) {
                foreach ($meta->associationMappings as $k => $associationMapping) {
                    $mappedClass = substr($associationMapping['targetEntity'], strpos($associationMapping['targetEntity'], '\\') + 1);

                    if ($associationMapping['targetEntity']!=$meta->name) {
                        unset($metadata[$key]->associationMappings[$k]);
                        $metadata[$key]->associationMappings[$mappedClass] = $associationMapping;
                        $metadata[$key]->associationMappings[$mappedClass]['fieldName'] = $mappedClass;
                        $metadata[$key]->associationMappings[$mappedClass]['inversedBy'] = substr($key, strpos($key, '\\') + 1);
                    }else{
                        $metadata[$key]->associationMappings[$k]['inversedBy'] = substr($key, strpos($key, '\\') + 1);
                        $mappedClass=$k;
                    }
                    
                    $mapping[$associationMapping['targetEntity']][] = array(
                        'fieldName' => substr($meta->name, strpos($meta->name, '\\') + 1),
                        'targetEntity' => $meta->name,
                        'mappedBy' => $mappedClass,
                        'joinColumns' => $associationMapping['joinColumns']);
                }
            }
        }
//        pre_print($mapping, false);
//        pre_print($metadata);
        foreach ($mapping as $key => $associationMappings) {
            foreach ($associationMappings as $i => $associationMapping) {
                $metadata[$key]->mapOneToMany($associationMapping);
            }
        }
//        pre_print($metadata, false);
//        exit;
        $generator = new Doctrine\ORM\Tools\EntityGenerator();
        $generator->setUpdateEntityIfExists(true);
        $generator->setGenerateStubMethods(true);
        $generator->setGenerateAnnotations(true);
        $generator->setRegenerateEntityIfExists(true);
        $generator->setAnnotationPrefix('');
        $generator->setFieldVisibility(Doctrine\ORM\Tools\EntityGenerator::FIELD_VISIBLE_PROTECTED);
        $generator->generate($metadata, APPPATH . 'models');
        print 'Done!';
    }

}