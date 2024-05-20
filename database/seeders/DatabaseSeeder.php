<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Entities\Departament;
use App\Entities\Office;
use Illuminate\Database\Seeder;
use App\Entities\User;
use App\Entities\Skill;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        // User::create([
        //     'cpf'         => '11122233345', 
        //     'name'        => 'Carlos', 
        //     'phone'       => '4899151515', 
        //     'birth'       => '2003-02-23', 
        //     'gender'      => 'M', 
        //     'notes'       => 'Pior Funcionario', 
        //     'email'       => 'carlos@gmail.com', 
        //     'departament_id'  => '1', 
        //     'office_id'       => '1', 
        //     'password'    => env('PASSWORD_HASH') ? bcrypt('admin12345*') : 'admin12345*', 
        // ]);

        // $departamentos = [
        //     'Engenharia',
        //     'Recursos Humanos',
        //     'Marketing',
        //     'Finanças',
        //     'Vendas',
        //     'TI',
        //     'Suporte ao Cliente',
        //     'Operações',
        //     'Pesquisa e Desenvolvimento',
        //     'Logística'
        // ];

        // foreach ($departamentos as $departamento) {
        //     Departament::create([
        //         'name' => $departamento, 
        //     ]);
        // }
        
        // $cargos = ['Engenheiro Civil', 'Engenheiro de Software', 'Engenheiro Elétrico',
        //     'Recrutador', 'Gerente de RH', 'Especialista em Benefícios',
        //     'Analista de Marketing', 'Gerente de Produto', 'Coordenador de Eventos',
        //     'Contador', 'Analista Financeiro', 'Tesoureiro',
        //     'Vendedor', 'Gerente de Vendas', 'Executivo de Contas',
        //     'Desenvolvedor', 'Administrador de Sistemas', 'Analista de Suporte',
        //     'Atendente', 'Especialista em Suporte', 'Coordenador de Suporte',
        //     'Gerente de Operações', 'Supervisor de Produção', 'Analista de Logística',
        //     'Cientista', 'Pesquisador', 'Engenheiro de P&D',
        //     'Coordenador de Logística', 'Analista de Transporte', 'Supervisor de Armazém', 'Assitente', 'Auxiliar'];

        // foreach ($cargos as $cargo) {
        //     Office::create(['name' => $cargo]);
        // } 

        // $skills = [
        //     // Soft Skills
        //     ['name' => 'Comunicação', 'type' => '1', 'description' => 'A habilidade de transmitir informações de forma clara e eficaz, tanto verbalmente quanto por escrito.'],
        //     ['name' => 'Trabalho em Equipe', 'type' => '1', 'description' => 'Capacidade de colaborar bem com colegas e contribuir para alcançar objetivos comuns.'],
        //     ['name' => 'Liderança', 'type' => '1', 'description' => 'Habilidade de guiar, inspirar e motivar uma equipe para atingir metas e resolver problemas.'],
        //     ['name' => 'Gestão do Tempo', 'type' => '1', 'description' => 'Capacidade de organizar e planejar quanto tempo gastar em atividades específicas para aumentar a eficiência.'],
        //     ['name' => 'Resolução de Problemas', 'type' => '1', 'description' => 'Habilidade de analisar situações complexas e desenvolver soluções eficazes para os desafios.'],
        //     ['name' => 'Empatia', 'type' => '1', 'description' => 'Capacidade de entender e compartilhar os sentimentos dos outros, promovendo relacionamentos positivos.'],
        //     ['name' => 'Adaptabilidade', 'type' => '1', 'description' => 'Capacidade de ajustar-se rapidamente a novas condições, desafios ou ambientes.'],
        //     ['name' => 'Pensamento Crítico', 'type' => '1', 'description' => 'Habilidade de analisar fatos de forma lógica e objetiva para formar um julgamento sólido.'],
        //     ['name' => 'Inteligência Emocional', 'type' => '1', 'description' => 'Capacidade de reconhecer, entender e gerenciar suas próprias emoções e as emoções dos outros.'],
        //     ['name' => 'Criatividade', 'type' => '1', 'description' => 'Habilidade de pensar fora da caixa e gerar ideias inovadoras e originais.'],

        //     // Hard Skills
        //     ['name' => 'Programação', 'type' => '2', 'description' => 'Habilidade de escrever código em linguagens de programação como Python, Java, ou C++.'],
        //     ['name' => 'Análise de Dados', 'type' => '2', 'description' => 'Capacidade de coletar, processar e interpretar grandes conjuntos de dados para tomar decisões informadas.'],
        //     ['name' => 'Design Gráfico', 'type' => '2', 'description' => 'Habilidade de criar conteúdo visual usando softwares como Adobe Photoshop e Illustrator.'],
        //     ['name' => 'Gestão de Projetos', 'type' => '2', 'description' => 'Competência em planejar, executar e fechar projetos, utilizando metodologias como Agile ou Waterfall.'],
        //     ['name' => 'Marketing Digital', 'type' => '2', 'description' => 'Conhecimento em promover produtos ou serviços através de plataformas digitais como SEO, SEM, e redes sociais.'],
        //     ['name' => 'Contabilidade', 'type' => '2', 'description' => 'Habilidade de gerenciar contas financeiras, preparar balanços e entender princípios contábeis.'],
        //     ['name' => 'Desenvolvimento Web', 'type' => '2', 'description' => 'Capacidade de construir e manter websites usando tecnologias como HTML, CSS, JavaScript, e frameworks.'],
        //     ['name' => 'Engenharia de Software', 'type' => '2', 'description' => 'Conhecimento em aplicar princípios de engenharia ao design, desenvolvimento e manutenção de software.'],
        //     ['name' => 'Habilidades em Office', 'type' => '2', 'description' => 'Proficiência no uso de ferramentas de produtividade como Microsoft Office (Word, Excel, PowerPoint).'],
        //     ['name' => 'Suporte Técnico', 'type' => '2', 'description' => 'Habilidade de fornecer assistência técnica e resolver problemas de hardware e software.'],
        // ];

        // foreach ($skills as $skill) {
        //     Skill::create($skill);
        // } 

    }
}
