<?php
/**
 * This file is part of PDepend.
 *
 * PHP Version 5
 *
 * Copyright (c) 2008-2017 Manuel Pichler <mapi@pdepend.org>.
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 *
 *   * Redistributions of source code must retain the above copyright
 *     notice, this list of conditions and the following disclaimer.
 *
 *   * Redistributions in binary form must reproduce the above copyright
 *     notice, this list of conditions and the following disclaimer in
 *     the documentation and/or other materials provided with the
 *     distribution.
 *
 *   * Neither the name of Manuel Pichler nor the names of his
 *     contributors may be used to endorse or promote products derived
 *     from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
 * FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 * COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
 * BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
 * LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
 * ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @copyright 2008-2017 Manuel Pichler. All rights reserved.
 * @license http://www.opensource.org/licenses/bsd-license.php BSD License
 * @since 2.3
 */

namespace PDepend\Source\Language\PHP;

use PDepend\AbstractTest;
use PDepend\Source\Builder\Builder;
use PDepend\Source\Tokenizer\Tokenizer;
use PDepend\Util\Cache\CacheDriver;

/**
 * Test case for the {@link \PDepend\Source\Language\PHP\PHPParserVersion55} class.
 *
 * @copyright 2008-2017 Manuel Pichler. All rights reserved.
 * @license http://www.opensource.org/licenses/bsd-license.php BSD License
 * @since 2.3
 *
 * @covers \PDepend\Source\Language\PHP\PHPParserVersion55
 * @group unittest
 */
class PHPParserVersion55Test extends AbstractTest
{
    /**
     * testParserThrowsExceptionForParameterWithExpressionValue
     *
     * @return void
     * @expectedException \PDepend\Source\Parser\UnexpectedTokenException
     */
    public function testParserThrowsExceptionForParameterWithExpressionValue()
    {
        $this->parseCodeResourceForTest();
    }

    /**
     * testParserThrowsExceptionForComplexExpressionInConstantDeclarator
     *
     * @return void
     * @expectedException \PDepend\Source\Parser\UnexpectedTokenException
     */
    public function testParserThrowsExceptionForComplexExpressionInConstantDeclarator()
    {
        $this->parseCodeResourceForTest();
    }

    /**
     * testParserThrowsExceptionForComplexExpressionInFieldDeclaration
     *
     * @return void
     * @expectedException \PDepend\Source\Parser\UnexpectedTokenException
     */
    public function testParserThrowsExceptionForComplexExpressionInFieldDeclaration()
    {
        $this->parseCodeResourceForTest();
    }

    /**
     * @return void
     * @expectedException \PDepend\Source\Parser\UnexpectedTokenException
     */
    public function testListKeywordAsMethodNameThrowsException()
    {
        $this->parseCodeResourceForTest();
    }

    /**
     * @return void
     * @expectedException \PDepend\Source\Parser\UnexpectedTokenException
     */
    public function testListKeywordAsFunctionNameThrowsException()
    {
        $this->parseCodeResourceForTest();
    }

    /**
     * @return void
     * @expectedException \PDepend\Source\Parser\UnexpectedTokenException
     * @expectedExceptionMessageRegExp (^Unexpected token: \.\.\., line: 6, col: 9, file: )
     */
    public function testEllipsisOperatorInFunctionCallThrowsException()
    {
        $this->parseCodeResourceForTest();
    }

    /**
     * Tests that the parser throws an exception when it detects an invalid
     * token in a method or property declaration.
     *
     * @return void
     */
    public function testParserThrowsUnexpectedTokenExceptionForInvalidTokenInPropertyDeclaration()
    {
        $this->setExpectedException(
            '\\PDepend\\Source\\Parser\\UnexpectedTokenException',
            'Unexpected token: const, line: 4, col: 13, file: '
        );

        $this->parseCodeResourceForTest();
    }

    /**
     * Tests that ::class is allowed PHP >= 5.5.
     *
     * @return void
     */
    public function testDoubleColonClass()
    {
        $this->assertInstanceOf('PDepend\Source\AST\ASTArtifactList', $this->parseCodeResourceForTest());
    }

    /**
     * @param \PDepend\Source\Tokenizer\Tokenizer $tokenizer
     * @param \PDepend\Source\Builder\Builder $builder
     * @param \PDepend\Util\Cache\CacheDriver $cache
     * @return \PDepend\Source\Language\PHP\AbstractPHPParser
     */
    protected function createPHPParser(Tokenizer $tokenizer, Builder $builder, CacheDriver $cache)
    {
        return $this->getMockForAbstractClass(
            'PDepend\\Source\\Language\\PHP\\PHPParserVersion55',
            array($tokenizer, $builder, $cache)
        );
    }
}
