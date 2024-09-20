<?php

use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\EnderecoController;
use App\Http\Controllers\CupomController;
use App\Http\Controllers\TransacaoController;

// Rotas para produtos
Route::get('/produtos', [ProdutoController::class, 'index'])->name('produtos.index');
Route::get('/produtos/{id}', [ProdutoController::class, 'show'])->name('produtos.show');
Route::post('/produtos', [ProdutoController::class, 'store'])->name('produtos.store');
Route::put('/produtos/{id}', [ProdutoController::class, 'update'])->name('produtos.update');
Route::delete('/produtos/{id}', [ProdutoController::class, 'destroy'])->name('produtos.destroy');

// Rotas para usuários
Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
Route::post('/usuarios', [UsuarioController::class, 'store'])->name('usuarios.store');
Route::get('/usuarios/{id}', [UsuarioController::class, 'show'])->name('usuarios.show');
Route::put('/usuarios/{id}', [UsuarioController::class, 'update'])->name('usuarios.update');
Route::delete('/usuarios/{id}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy');

// Rotas para endereços
Route::get('/enderecos', [EnderecoController::class, 'index'])->name('enderecos.index');
Route::post('/enderecos', [EnderecoController::class, 'store'])->name('enderecos.store');
Route::get('/enderecos/{id}', [EnderecoController::class, 'show'])->name('enderecos.show');
Route::put('/enderecos/{id}', [EnderecoController::class, 'update'])->name('enderecos.update');
Route::delete('/enderecos/{id}', [EnderecoController::class, 'destroy'])->name('enderecos.destroy');

// Rotas para cupons
Route::get('/cupons', [CupomController::class, 'index'])->name('cupons.index');
Route::post('/cupons', [CupomController::class, 'store'])->name('cupons.store');
Route::get('/cupons/{id}', [CupomController::class, 'show'])->name('cupons.show');
Route::put('/cupons/{id}', [CupomController::class, 'update'])->name('cupons.update');
Route::delete('/cupons/{id}', [CupomController::class, 'destroy'])->name('cupons.destroy');

// Rotas para transações
Route::get('/transacoes', [TransacaoController::class, 'index'])->name('transacoes.index');
Route::post('/transacoes', [TransacaoController::class, 'store'])->name('transacoes.store');
Route::get('/transacoes/{id}', [TransacaoController::class, 'show'])->name('transacoes.show');
Route::put('/transacoes/{id}', [TransacaoController::class, 'update'])->name('transacoes.update');
Route::delete('/transacoes/{id}', [TransacaoController::class, 'destroy'])->name('transacoes.destroy');
