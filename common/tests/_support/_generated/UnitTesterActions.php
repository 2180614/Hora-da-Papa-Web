<?php  //[STAMP] 4d737252a630acd8156f28aed619854f
namespace common\tests\_generated;

// This class was automatically generated by build task
// You should not change it manually as it will be overwritten on next build
// @codingStandardsIgnoreFile

trait UnitTesterActions
{
    /**
     * @return \Codeception\Scenario
     */
    abstract protected function getScenario();

    
    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Creates and loads fixtures from a config.
     * The signature is the same as for the `fixtures()` method of `yii\test\FixtureTrait`
     *
     * ```php
     * <?php
     * $I->haveFixtures([
     *     'posts' => PostsFixture::className(),
     *     'user' => [
     *         'class' => UserFixture::className(),
     *         'dataFile' => '@tests/_data/models/user.php',
     *      ],
     * ]);
     * ```
     *
     * Note: if you need to load fixtures before a test (probably before the
     * cleanup transaction is started; `cleanup` option is `true` by default),
     * you can specify the fixtures in the `_fixtures()` method of a test case
     *
     * ```php
     * <?php
     * // inside Cest file or Codeception\TestCase\Unit
     * public function _fixtures(){
     *     return [
     *         'user' => [
     *             'class' => UserFixture::className(),
     *             'dataFile' => codecept_data_dir() . 'user.php'
     *         ]
     *     ];
     * }
     * ```
     * instead of calling `haveFixtures` in Cest `_before`
     *
     * @param $fixtures
     * @part fixtures
     * @see \Codeception\Module\Yii2::haveFixtures()
     */
    public function haveFixtures($fixtures) {
        return $this->getScenario()->runStep(new \Codeception\Step\Action('haveFixtures', func_get_args()));
    }

 
    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Returns all loaded fixtures.
     * Array of fixture instances
     *
     * @part fixtures
     * @return array
     * @see \Codeception\Module\Yii2::grabFixtures()
     */
    public function grabFixtures() {
        return $this->getScenario()->runStep(new \Codeception\Step\Action('grabFixtures', func_get_args()));
    }

 
    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Gets a fixture by name.
     * Returns a Fixture instance. If a fixture is an instance of
     * `\yii\test\BaseActiveFixture` a second parameter can be used to return a
     * specific model:
     *
     * ```php
     * <?php
     * $I->haveFixtures(['users' => UserFixture::className()]);
     *
     * $users = $I->grabFixture('users');
     *
     * // get first user by key, if a fixture is an instance of ActiveFixture
     * $user = $I->grabFixture('users', 'user1');
     * ```
     *
     * @param $name
     * @return mixed
     * @throws ModuleException if the fixture is not found
     * @part fixtures
     * @see \Codeception\Module\Yii2::grabFixture()
     */
    public function grabFixture($name, $index = NULL) {
        return $this->getScenario()->runStep(new \Codeception\Step\Action('grabFixture', func_get_args()));
    }
}
