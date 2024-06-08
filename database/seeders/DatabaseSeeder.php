<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Entities\Departament;
use App\Entities\Office;
use App\Entities\Question;
use Illuminate\Database\Seeder;
use App\Entities\User;
use App\Entities\Skill;
use App\Entities\TypeQuestion;
use App\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

    }
    
    private function SeederUser() : void
    {
        User::create([
            'cpf'         => '11122233399', 
            'name'        => 'Gabriel', 
            'phone'       => '4899151515', 
            'birth'       => '2003-02-23', 
            'gender'      => 'M', 
            'notes'       => 'Funcionario', 
            'email'       => 'gabriel@gmail.com', 
            'departament_id'  => '2', 
            'office_id'       => '2', 
            'password'    => env('PASSWORD_HASH') ? bcrypt('admin12345*') : 'senha12345*', 
        ]);

    }

    private function SeederDepartamentos() : void
    {
        $departamentos = [
            'Engenharia',
            'Recursos Humanos',
            'Marketing',
            'Finanças',
            'Vendas',
            'TI',
            'Suporte ao Cliente',
            'Operações',
            'Pesquisa e Desenvolvimento',
            'Logística'
        ];

        foreach ($departamentos as $departamento) {
            Departament::create([
                'name' => $departamento, 
            ]);
        }
    }

    private function SeederCargos() : void
    {
        $cargos = ['Engenheiro Civil', 'Engenheiro de Software', 'Engenheiro Elétrico',
            'Recrutador', 'Gerente de RH', 'Especialista em Benefícios',
            'Analista de Marketing', 'Gerente de Produto', 'Coordenador de Eventos',
            'Contador', 'Analista Financeiro', 'Tesoureiro',
            'Vendedor', 'Gerente de Vendas', 'Executivo de Contas',
            'Desenvolvedor', 'Administrador de Sistemas', 'Analista de Suporte',
            'Atendente', 'Especialista em Suporte', 'Coordenador de Suporte',
            'Gerente de Operações', 'Supervisor de Produção', 'Analista de Logística',
            'Cientista', 'Pesquisador', 'Engenheiro de P&D',
            'Coordenador de Logística', 'Analista de Transporte', 'Supervisor de Armazém', 'Assitente', 'Auxiliar'];

        foreach ($cargos as $cargo) {
            Office::create(['name' => $cargo]);
        } 
    }

    private function SeederSkills() : void
    { 
        $skills = [
            // Soft Skills
            ['name' => 'Comunicação', 'type' => '1', 'description' => 'A habilidade de transmitir informações de forma clara e eficaz, tanto verbalmente quanto por escrito.'],
            ['name' => 'Trabalho em Equipe', 'type' => '1', 'description' => 'Capacidade de colaborar bem com colegas e contribuir para alcançar objetivos comuns.'],
            ['name' => 'Liderança', 'type' => '1', 'description' => 'Habilidade de guiar, inspirar e motivar uma equipe para atingir metas e resolver problemas.'],
            ['name' => 'Gestão do Tempo', 'type' => '1', 'description' => 'Capacidade de organizar e planejar quanto tempo gastar em atividades específicas para aumentar a eficiência.'],
            ['name' => 'Resolução de Problemas', 'type' => '1', 'description' => 'Habilidade de analisar situações complexas e desenvolver soluções eficazes para os desafios.'],
            ['name' => 'Empatia', 'type' => '1', 'description' => 'Capacidade de entender e compartilhar os sentimentos dos outros, promovendo relacionamentos positivos.'],
            ['name' => 'Adaptabilidade', 'type' => '1', 'description' => 'Capacidade de ajustar-se rapidamente a novas condições, desafios ou ambientes.'],
            ['name' => 'Pensamento Crítico', 'type' => '1', 'description' => 'Habilidade de analisar fatos de forma lógica e objetiva para formar um julgamento sólido.'],
            ['name' => 'Inteligência Emocional', 'type' => '1', 'description' => 'Capacidade de reconhecer, entender e gerenciar suas próprias emoções e as emoções dos outros.'],
            ['name' => 'Criatividade', 'type' => '1', 'description' => 'Habilidade de pensar fora da caixa e gerar ideias inovadoras e originais.'],

            // Hard Skills
            ['name' => 'Programação', 'type' => '2', 'description' => 'Habilidade de escrever código em linguagens de programação como Python, Java, ou C++.'],
            ['name' => 'Análise de Dados', 'type' => '2', 'description' => 'Capacidade de coletar, processar e interpretar grandes conjuntos de dados para tomar decisões informadas.'],
            ['name' => 'Design Gráfico', 'type' => '2', 'description' => 'Habilidade de criar conteúdo visual usando softwares como Adobe Photoshop e Illustrator.'],
            ['name' => 'Gestão de Projetos', 'type' => '2', 'description' => 'Competência em planejar, executar e fechar projetos, utilizando metodologias como Agile ou Waterfall.'],
            ['name' => 'Marketing Digital', 'type' => '2', 'description' => 'Conhecimento em promover produtos ou serviços através de plataformas digitais como SEO, SEM, e redes sociais.'],
            ['name' => 'Contabilidade', 'type' => '2', 'description' => 'Habilidade de gerenciar contas financeiras, preparar balanços e entender princípios contábeis.'],
            ['name' => 'Desenvolvimento Web', 'type' => '2', 'description' => 'Capacidade de construir e manter websites usando tecnologias como HTML, CSS, JavaScript, e frameworks.'],
            ['name' => 'Engenharia de Software', 'type' => '2', 'description' => 'Conhecimento em aplicar princípios de engenharia ao design, desenvolvimento e manutenção de software.'],
            ['name' => 'Habilidades em Office', 'type' => '2', 'description' => 'Proficiência no uso de ferramentas de produtividade como Microsoft Office (Word, Excel, PowerPoint).'],
            ['name' => 'Suporte Técnico', 'type' => '2', 'description' => 'Habilidade de fornecer assistência técnica e resolver problemas de hardware e software.'],
        ];

        foreach ($skills as $skill) {
            Skill::create($skill);
        } 
    }


    private function SeederPermissoes() : void
    { 
        $permissions = [
            'app.admin',
            'app.user',
            'app.manager'
        ];

        foreach ($permissions as $permission) {
           
            Permission::create([
                'name' => $permission, 
            ]);
        }
    }

    private function SeederTypeQuestios() : void
    { 
        $typeQuestions = [
            'Comunicação',
            'Foco e Orientação para Resultados',
            'Inovação, Qualidade e Melhoria Contínua',
            'Liderança e Gestão de Equipes de Alto Desempenho',
            'Autodesenvolvimento',
            'Qualidade de Vida e Segurança do Trabalho',
            'Visão Estratégica e Sistêmica'
        ];
    
        foreach ($typeQuestions as $typeQuestion) {
        
            TypeQuestion::create([
                'name' => $typeQuestion, 
            ]);
        }
    }

    private function SeederQuestions() : void
    { 
        $questions = [
           
            ['type_question_id' => 1
                , 'order' => 1
                , 'question_description' => 'Transmite informações de forma clara e objetiva, ouve com atenção e preocupa-se em assegurar o entendimento das informações por parte dos receptores.'],
            ['type_question_id' => 1
                , 'order' => 2
                , 'question_description' => 'Sabe claramente as diretrizes e estratégias da empresa e compartilha as informações, objetivos, metas e os resultados alcançados em reuniões periódicas.'],
            ['type_question_id' => 2
                , 'order' => 3
                , 'question_description' => 'Planeja e controla com disciplina as atividades da área por meio de análise de indicadores e corrige desvios de forma ágil.'],
            ['type_question_id' => 2
                , 'order' => 4
                , 'question_description' => 'Atinge os objetivos e metas da área efetivando planos de ação que geram economia/redução de custos, redução de desperdícios, ganhos de produtividade e qualidade, aumento da receita, atendimento de prazos, etc;'],
            ['type_question_id' => 3
                , 'order' => 5
                , 'question_description' => 'Desenvolve, revisa, cumpre e compartilha os procedimentos, normas e políticas da empresa, garantindo que sua equipe
                também atue de acordo com as mesmas.'],
            ['type_question_id' => 3
                , 'order' => 6
                , 'question_description' => 'É criativo e inovador, apresentando e implementando soluções para os novos desafios, utilizando ferramentas e
                metodologias da Qualidade e Lean Manufacturing (exemplos: 5S, PDCA, 5W2H, kaizen, A3, FMEA, etc.)'],
            ['type_question_id' => 3
                , 'order' => 7
                , 'question_description' => 'É aberto, flexível e reage positivamente as mudanças, tem facilidade de adaptação para utilização de novos métodos,
                procedimentos e estratégias.'],
            ['type_question_id' => 3
                , 'order' => 8
                , 'question_description' => 'Incentiva os colaboradores a proporem suas ideias, avaliando e viabilizando a implementação em prol dos resultados da
                área e da melhoria contínua.'],
            ['type_question_id' => 3
                , 'order' => 9
                , 'question_description' => 'Promove a cultura do "foco no cliente", compromete-se com a melhoria dos processos, produtos e serviços para atender
                as necessidades dos clientes internos/externos.'],

            ['type_question_id' => 4
                , 'order' => 10
                , 'question_description' => 'Respeita a diversidade (raça, crença, orientação sexual, deficiência, cultura, entre outros), promove um ambiente de
                trabalho inclusivo, livre de preconceitos e discriminação.'],
            ['type_question_id' => 4
                , 'order' => 11
                , 'question_description' => 'Exerce a liderança pelo exemplo, atuando de forma transparente e justa, com idoneidade, ética e respeito, inspirando
                confiança.'],
            ['type_question_id' => 4
                , 'order' => 12
                , 'question_description' => 'Coopera com outras áreas do négocio e estimula comportamentos similares em sua equipe em prol dos resultados.'],
            ['type_question_id' => 4
                , 'order' => 13
                , 'question_description' => 'Comemora as metas e conquistas alcançadas, reconhece e elogia o trabalho bem feito/diferenciado da equipe e dos
                pares.'],
            ['type_question_id' => 4
                , 'order' => 14
                , 'question_description' => 'Pratica o feedback como ferramenta para elevar a performance, cumprindo o cronograma das avaliações de sua equipe,
                dando suporte nas ações de treinamento e desenvolvimento.'],
            ['type_question_id' => 4
                , 'order' => 15
                , 'question_description' => 'Divide seu conhecimento e experiências de forma espontânea, incentivando o desenvolvimento da equipe, avalia
                necessidades e promove treinamentos e atualizações de procedimentos e normas de trabalho, identificando talentos e
                sucessores.'],

            ['type_question_id' => 5
                , 'order' => 16
                , 'question_description' => 'Preocupa-se com o seu desenvolvimento pessoal e profissional, investe tempo e esforço em adquirir novos
                conhecimentos, tomando para si a responsabilidade de manter-se atualizado, bem como participa dos treinamentos,
                programas e ações promovidos pela empresa.'],
         
            ['type_question_id' => 6
                , 'order' => 17
                , 'question_description' => 'Cumpre e assegura que sua equipe siga as normas de segurança e utilize corretamente os EPIs e EPCs.'],
                
            ['type_question_id' => 6
                , 'order' => 18
                , 'question_description' => 'Promove um ambiente físico e social saudável assegurando clima e condições favoráveis para o trabalho, demonstrando
                interesse genuíno pela saúde e segurança das pessoas.'],

            ['type_question_id' => 7
                , 'order' => 19
                , 'question_description' => 'Apresenta a visão do todo, percebe a interdependência da sua área com as demais, e toma decisões assertivas
                utilizando critérios lógicos e fatos/dados consistentes para alcançar os melhores resultados para a empresa.'],
            ['type_question_id' => 7
                , 'order' => 20
                , 'question_description' => 'Toma decisões de forma estratégica considerando as perspectivas de curto a longo prazo, atentando-se para os riscos
                envolvidos, compartilhando as mais complexas com seus pares/superiores, respeitando as alçadas e políticas da empresa.'],
        ];

        foreach ($questions as $question) {
           
            Question::create(
                $question
            );
        }
    }
    

}
