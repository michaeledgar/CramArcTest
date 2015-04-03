<?php
/**
 * Copyright 2014 Google Inc. All Rights Reserved.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/**
 * Unit test engine wrapper which runs cram and parses the XUnit output.
 *
 * No coverage support yet.
 */
final class CramTestEngine extends ArcanistUnitTestEngine {

  public function run() {
    $working_copy = $this->getWorkingCopy();
    $project_root = $working_copy->getProjectRoot();
    $tests = $this->getConfigurationManager()->getConfigFromAnySource('unit.engine.cram.tests');
    $absolute_test_dir = Filesystem::resolvePath($project_root);
    $absolute_tests = Filesystem::resolvePath($project_root) . '/' . $tests;

    $xunit_tmp = new TempFile();

    $future = new ExecFuture('cram --xunit-file=%s %s', $xunit_tmp, $absolute_tests);
    $future->setCWD($absolute_test_dir);
    list($stdout, $stderr) = $future->resolvex();

    $parser = new ArcanistXUnitTestResultParser();
    $results = $parser->parseTestResults(Filesystem::readFile($xunit_tmp));
    return $results;
  }
}

?>
