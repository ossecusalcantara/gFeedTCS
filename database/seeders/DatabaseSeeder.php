<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Entities\AnswersEvaluation;
use App\Entities\Departament;
use App\Entities\Feedback;
use App\Entities\Office;
use App\Entities\PerformanceEvaluation;
use App\Entities\Question;
use Illuminate\Database\Seeder;
use App\Entities\User;
use App\Entities\Skill;
use App\Entities\SkillProfile;
use App\Entities\TypeQuestion;
use App\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->SeederDepartamentos();
        $this->SeederCargos();
        $this->SeederSkills();
        $this->SeederTypeQuestios();
        $this->SeederPermissoes();
        $this->SeedQuestions1();
        $this->SeederQuestions2();
        $this->SeederUser();
        $this->SeedAvaliacao();
        $this->SeedFeedback(20);
    }

    private function SeedAvaliacao() : void {

        $avaliacoes = [
            ['notes' => 'Avaliação de 30 dias',
            'deadline' => '2024-01-12',
            'media' => 3.1,
            'admin_id' => 3,
            'manager_id' => 2,
            'user_id' => 1,
            'level' => 1,
            'conclusion' => '2024-01-12',
            'status' => 'completed'],

            ['notes' => 'Avaliação de 90 dias',
            'deadline' => '2024-03-12',
            'media' => 4,
            'admin_id' => 3,
            'manager_id' => 2,
            'user_id' => 1,
            'level' => 1,
            'conclusion' => '2024-03-12',
            'status' => 'completed'],

            ['notes' => 'Avaliação de 1 ano',
            'deadline' => '2024-07-12',
            'admin_id' => 3,
            'manager_id' => 2,
            'user_id' => 1,
            'level' => 1],
        ];

        foreach ($avaliacoes as $value) {
            PerformanceEvaluation::create($value);

            $latestRecord = PerformanceEvaluation::latest()->first();

            if(isset($value['status'])) {
                if($value['status'] == 'completed') {
                    $this->SeedPerguntas($latestRecord->id);
                }
            }
        }

    }

    private function SeedFeedback($quatidade) : void 
     {

        for ($i=0; $i < $quatidade; $i++) { 
            $feedbacks = [
                'reason' => $this->textoAleatorio(4),
                'notes' => $this->textoAleatorio(10),
                'user_id' => rand(1,3),
                'register_id' => rand(1,3)
            ];

            $latestRecord =   Feedback::create($feedbacks);

            $this->SeedSkillProfile($latestRecord);
            
        }

    }

    private function SeedSkillProfile(Feedback $feedback) : void 
    {

        $qtd = rand(3, 8);
        for ($i=0; $i < $qtd; $i++) { 
            
            $id = rand(1,20);
            $skill = Skill::where('id', $id)->first();

            $skillP = [
                'user_id' =>  $feedback->user_id ,
                'skill_id' => $skill->id,
                'pontuation' => rand(1,10),
                'feedback_id' => $feedback->id
            ];

            SkillProfile::create($skillP);

        }

    }

    private function SeedPerguntas($avaliacao, $nivel = 1) : void
    {

        
        $questions = Question::where('level', $nivel)->orderBy('order', 'asc')->get();
        
        foreach ($questions as $key => $question) {
            $perguntas = [
                'question_id' => $question->id,
                'performance_evaluation_id' => $avaliacao,
                'notes' => $this->textoAleatorio(),
                'punctuation' => rand(1,4), 
    
            ];
            
            AnswersEvaluation::create($perguntas);
        }

    }
    
    private function SeederUser() : void
    {
        $user = User::create([
            'cpf'         => '11122233388', 
            'name'        => 'Gabriel Chaucoski', 
            'phone'       => '4899150055', 
            'birth'       => '2003-02-23', 
            'gender'      => 'M', 
            'notes'       =>  $this->textoAleatorio(5), 
            'email'       => 'gabriel@gmail.com', 
            'departament_id'  => '6', 
            'office_id'       => '16', 
            'permission'  => 'app.user',
            'password'    => env('PASSWORD_HASH') ? bcrypt('gfeed2024*') : 'gfeed2024*', 
        ]);

        $user->assignPermission('app.user');

        $userManager = User::create([
            'cpf'         => '11166633399', 
            'name'        => 'Adson Alcântara', 
            'phone'       => '4891591515', 
            'birth'       => '1998-02-23', 
            'gender'      => 'M', 
            'notes'       => $this->textoAleatorio(6), 
            'email'       => 'adson@gmail.com', 
            'departament_id'  => '6', 
            'office_id'       => '2', 
            'permission'  => 'app.manager',
            'password'    => env('PASSWORD_HASH') ? bcrypt('gfeed2024*') : 'gfeed2024*', 
        ]);

        $userManager->assignPermission('app.manager');

        $userAdmin = User::create([
            'cpf'         => '22222233399', 
            'name'        => 'Rogerio Ricardo', 
            'phone'       => '4866551515', 
            'birth'       => '2005-02-23', 
            'gender'      => 'M', 
            'notes'       => $this->textoAleatorio(7), 
            'email'       => 'rogerio@gmail.com', 
            'departament_id'  => '2', 
            'office_id'       => '5', 
            'permission'  => 'app.admin',
            'password'    => env('PASSWORD_HASH') ? bcrypt('gfeed2024*') : 'gfeed2024*', 
        ]);

        $userAdmin->assignPermission('app.admin');

    }

    private function SeederDepartamentos() : void
    {
        $departamentos = [
            ['name' => 'Engenharia', 'description' => 'Responsável pelo desenvolvimento e manutenção dos produtos.'],
            ['name' => 'Recursos Humanos', 'description' => 'Gerencia a contratação, treinamento e bem-estar dos funcionários.'],
            ['name' => 'Marketing', 'description' => 'Cuida da promoção e publicidade dos produtos e serviços da empresa.'],
            ['name' => 'Finanças', 'description' => 'Responsável pela gestão financeira e planejamento orçamentário.'],
            ['name' => 'Vendas', 'description' => 'Trabalha para vender os produtos e serviços da empresa aos clientes.'],
            ['name' => 'TI', 'description' => 'Suporta a infraestrutura tecnológica e sistemas da empresa.'],
            ['name' => 'Suporte ao Cliente', 'description' => 'Atende e resolve as dúvidas e problemas dos clientes.'],
            ['name' => 'Operações', 'description' => 'Gerencia as operações diárias e a logística interna.'],
            ['name' => 'Pesquisa e Desenvolvimento', 'description' => 'Foca na inovação e no desenvolvimento de novos produtos.'],
            ['name' => 'Logística', 'description' => 'Cuida da armazenagem, transporte e distribuição de produtos.']
        ];
    
        foreach ($departamentos as $departamento) {
            Departament::create($departamento);
        }
    }

    private function SeederCargos() : void
    {
        $cargos = [
            ['name' => 'Engenheiro Civil', 'description' => 'Planeja, projeta e supervisiona construções e infraestruturas.'],
            ['name' => 'Engenheiro de Software', 'description' => 'Desenvolve e mantém sistemas de software.'],
            ['name' => 'Engenheiro Elétrico', 'description' => 'Projeta e gerencia equipamentos elétricos e eletrônicos.'],
            ['name' => 'Recrutador', 'description' => 'Responsável pela seleção e contratação de novos funcionários.'],
            ['name' => 'Gerente de RH', 'description' => 'Gerencia as atividades do departamento de Recursos Humanos.'],
            ['name' => 'Especialista em Benefícios', 'description' => 'Administra os programas de benefícios dos funcionários.'],
            ['name' => 'Analista de Marketing', 'description' => 'Desenvolve estratégias de marketing para promover produtos e serviços.'],
            ['name' => 'Gerente de Produto', 'description' => 'Supervisiona o desenvolvimento e a estratégia de produtos.'],
            ['name' => 'Coordenador de Eventos', 'description' => 'Planeja e executa eventos corporativos.'],
            ['name' => 'Contador', 'description' => 'Gerencia e analisa as finanças e contabilidade da empresa.'],
            ['name' => 'Analista Financeiro', 'description' => 'Analisa dados financeiros para apoiar decisões de negócios.'],
            ['name' => 'Tesoureiro', 'description' => 'Gerencia o fluxo de caixa e as operações financeiras.'],
            ['name' => 'Vendedor', 'description' => 'Realiza vendas de produtos e serviços aos clientes.'],
            ['name' => 'Gerente de Vendas', 'description' => 'Lidera a equipe de vendas e desenvolve estratégias de vendas.'],
            ['name' => 'Executivo de Contas', 'description' => 'Administra relacionamentos com clientes e gerencia contas importantes.'],
            ['name' => 'Desenvolvedor', 'description' => 'Cria e mantém aplicativos de software.'],
            ['name' => 'Administrador de Sistemas', 'description' => 'Gerencia e mantém a infraestrutura de TI da empresa.'],
            ['name' => 'Analista de Suporte', 'description' => 'Fornece suporte técnico e resolve problemas de TI.'],
            ['name' => 'Atendente', 'description' => 'Atende e auxilia os clientes em suas necessidades.'],
            ['name' => 'Especialista em Suporte', 'description' => 'Resolve problemas complexos de suporte ao cliente.'],
            ['name' => 'Coordenador de Suporte', 'description' => 'Supervisiona a equipe de suporte ao cliente.'],
            ['name' => 'Gerente de Operações', 'description' => 'Coordena as operações diárias da empresa.'],
            ['name' => 'Supervisor de Produção', 'description' => 'Supervisiona a linha de produção e garante a eficiência.'],
            ['name' => 'Analista de Logística', 'description' => 'Gerencia e otimiza a cadeia de suprimentos e logística.'],
            ['name' => 'Cientista', 'description' => 'Conduz pesquisas e experimentos científicos.'],
            ['name' => 'Pesquisador', 'description' => 'Desenvolve projetos de pesquisa em diversas áreas.'],
            ['name' => 'Engenheiro de P&D', 'description' => 'Trabalha no desenvolvimento de novos produtos e tecnologias.'],
            ['name' => 'Coordenador de Logística', 'description' => 'Gerencia as operações logísticas da empresa.'],
            ['name' => 'Analista de Transporte', 'description' => 'Planeja e gerencia as operações de transporte.'],
            ['name' => 'Supervisor de Armazém', 'description' => 'Supervisiona as operações de armazenagem.'],
            ['name' => 'Assistente', 'description' => 'Apoia em tarefas administrativas e operacionais.'],
            ['name' => 'Auxiliar', 'description' => 'Realiza atividades de apoio em diversas áreas.'],
        ];
    
        foreach ($cargos as $cargo) {
            Office::create($cargo);
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
            ['name' => 'app.admin' ,'description' => 'Administrador'],
            ['name' => 'app.user' ,'description' => 'Usuário'],
            ['name' => 'app.manager' ,'description' => 'Gestor']
        ];

        foreach ($permissions as $permission) {
           
            Permission::create($permission);
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
            'Visão Estratégica e Sistêmica',
            'Produtividade',
            'Diversidade e Adaptabilidade',
            'Engajamento e Trabalho em Equipe',
            'Segurança no Trabalho',
            'Assiduidade e Pontualidade',

        ];
    
        foreach ($typeQuestions as $typeQuestion) {
        
            TypeQuestion::create([
                'name' => $typeQuestion, 
            ]);
        }
    }

    private function SeederQuestions2() : void
    { 
        $questions = [
           
            ['type_question_id' => 1
                , 'level' => 2
                , 'order' => 1
                , 'question_description' => 'Transmite informações de forma clara e objetiva, ouve com atenção e preocupa-se em assegurar o entendimento das informações por parte dos receptores.'],
            ['type_question_id' => 1
                , 'level' => 2
                , 'order' => 2
                , 'question_description' => 'Sabe claramente as diretrizes e estratégias da empresa e compartilha as informações, objetivos, metas e os resultados alcançados em reuniões periódicas.'],
            ['type_question_id' => 2
                , 'level' => 2
                , 'order' => 3
                , 'question_description' => 'Planeja e controla com disciplina as atividades da área por meio de análise de indicadores e corrige desvios de forma ágil.'],
            ['type_question_id' => 2
                , 'level' => 2
                , 'order' => 4
                , 'question_description' => 'Atinge os objetivos e metas da área efetivando planos de ação que geram economia/redução de custos, redução de desperdícios, ganhos de produtividade e qualidade, aumento da receita, atendimento de prazos, etc;'],
            ['type_question_id' => 3
                , 'level' => 2
                , 'order' => 5
                , 'question_description' => 'Desenvolve, revisa, cumpre e compartilha os procedimentos, normas e políticas da empresa, garantindo que sua equipe
                também atue de acordo com as mesmas.'],
            ['type_question_id' => 3
                , 'level' => 2
                , 'order' => 6
                , 'question_description' => 'É criativo e inovador, apresentando e implementando soluções para os novos desafios, utilizando ferramentas e
                metodologias da Qualidade e Lean Manufacturing (exemplos: 5S, PDCA, 5W2H, kaizen, A3, FMEA, etc.)'],
            ['type_question_id' => 3
                , 'level' => 2
                , 'order' => 7
                , 'question_description' => 'É aberto, flexível e reage positivamente as mudanças, tem facilidade de adaptação para utilização de novos métodos,
                procedimentos e estratégias.'],
            ['type_question_id' => 3
                , 'level' => 2
                , 'order' => 8
                , 'question_description' => 'Incentiva os colaboradores a proporem suas ideias, avaliando e viabilizando a implementação em prol dos resultados da
                área e da melhoria contínua.'],
            ['type_question_id' => 3
                , 'level' => 2
                , 'order' => 9
                , 'question_description' => 'Promove a cultura do "foco no cliente", compromete-se com a melhoria dos processos, produtos e serviços para atender
                as necessidades dos clientes internos/externos.'],

            ['type_question_id' => 4
                , 'level' => 2
                , 'order' => 10
                , 'question_description' => 'Respeita a diversidade (raça, crença, orientação sexual, deficiência, cultura, entre outros), promove um ambiente de
                trabalho inclusivo, livre de preconceitos e discriminação.'],
            ['type_question_id' => 4
                , 'level' => 2
                , 'order' => 11
                , 'question_description' => 'Exerce a liderança pelo exemplo, atuando de forma transparente e justa, com idoneidade, ética e respeito, inspirando
                confiança.'],
            ['type_question_id' => 4
                , 'level' => 2
                , 'order' => 12
                , 'question_description' => 'Coopera com outras áreas do négocio e estimula comportamentos similares em sua equipe em prol dos resultados.'],
            ['type_question_id' => 4
                , 'level' => 2
                , 'order' => 13
                , 'question_description' => 'Comemora as metas e conquistas alcançadas, reconhece e elogia o trabalho bem feito/diferenciado da equipe e dos
                pares.'],
            ['type_question_id' => 4
                , 'level' => 2
                , 'order' => 14
                , 'question_description' => 'Pratica o feedback como ferramenta para elevar a performance, cumprindo o cronograma das avaliações de sua equipe,
                dando suporte nas ações de treinamento e desenvolvimento.'],
            ['type_question_id' => 4
                , 'level' => 2
                , 'order' => 15
                , 'question_description' => 'Divide seu conhecimento e experiências de forma espontânea, incentivando o desenvolvimento da equipe, avalia
                necessidades e promove treinamentos e atualizações de procedimentos e normas de trabalho, identificando talentos e
                sucessores.'],

            ['type_question_id' => 5
                , 'level' => 2
                , 'order' => 16
                , 'question_description' => 'Preocupa-se com o seu desenvolvimento pessoal e profissional, investe tempo e esforço em adquirir novos
                conhecimentos, tomando para si a responsabilidade de manter-se atualizado, bem como participa dos treinamentos,
                programas e ações promovidos pela empresa.'],
         
            ['type_question_id' => 6
                , 'level' => 2
                , 'order' => 17
                , 'question_description' => 'Cumpre e assegura que sua equipe siga as normas de segurança e utilize corretamente os EPIs e EPCs.'],
                
            ['type_question_id' => 6
                , 'level' => 2
                , 'order' => 18
                , 'question_description' => 'Promove um ambiente físico e social saudável assegurando clima e condições favoráveis para o trabalho, demonstrando
                interesse genuíno pela saúde e segurança das pessoas.'],

            ['type_question_id' => 7
                , 'level' => 2
                , 'order' => 19
                , 'question_description' => 'Apresenta a visão do todo, percebe a interdependência da sua área com as demais, e toma decisões assertivas
                utilizando critérios lógicos e fatos/dados consistentes para alcançar os melhores resultados para a empresa.'],
            ['type_question_id' => 7
                , 'level' => 2
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

    private function SeedQuestions1() : void {
        $questions1 = [
           
            ['type_question_id' => 1
                , 'level' => 1
                , 'order' => 1
                , 'question_description' => 'Transmite informações de forma clara e objetiva, ouve com atenção e preocupa-se em assegurar o entendimento das informações por parte dos receptores.'],
            ['type_question_id' => 7
                , 'level' => 1
                , 'order' => 2
                , 'question_description' => 'Atende as demandas de trabalho esperadas em determinado tempo dentro de metas adequadas para função.'],
            ['type_question_id' => 3
                , 'level' => 1
                , 'order' => 3
                , 'question_description' => 'Conhece os procedimentos e normas do seu setor, realizando suas tarefas de forma completa e precisa, sem desperdícios,
                    atendendo aos padrões de qualidade esperados.'],
            ['type_question_id' => 3
                , 'level' => 1
                , 'order' => 4
                , 'question_description' => 'Identifica e propõe ideias e melhorias.'],
            ['type_question_id' => 8
                , 'level' => 1
                , 'order' => 5
                , 'question_description' => 'Respeita a diversidade (raça, crença, orientação sexual, deficiência, cultura, entre outros) proporcionando um ambiente livre
                de discriminação'],
            ['type_question_id' => 8
                , 'level' => 1
                , 'order' => 6
                , 'question_description' => ' É flexível e reage positivamente as mudanças necessárias e tem facilidade de adaptação para utilização de novos métodos,
                procedimentos e estratégias.'],
            ['type_question_id' => 9
                , 'level' => 1
                , 'order' => 7
                , 'question_description' => 'Tem comportamentos que servem de exemplos para os colegas: comprometido com objetivos e metas, responsável e
                participativo.'],
            ['type_question_id' => 9
                , 'level' => 1
                , 'order' => 8
                , 'question_description' => 'Mantém organizado e limpo seu local de trabalho e espaços coletivos (refeitório, banheiros, salas de reuniões, pátios, entre
                outros).'],
            ['type_question_id' => 9
                , 'level' => 1
                , 'order' => 9
                , 'question_description' => 'Colabora/Ajuda em qualquer situação e divide seu conhecimento/experiências com colegas de forma espontânea.'],
            ['type_question_id' => 5
                , 'level' => 1
                , 'order' => 10
                , 'question_description' => ' Preocupa-se com o seu desenvolvimento, investe tempo e esforço em adquirir novos conhecimentos, tomando para si a
                responsabilidade de manter-se atualizado, bem como participa dos treinamentos promovidos pela empresa.'],
            ['type_question_id' => 11
                , 'level' => 1
                , 'order' => 11
                , 'question_description' => 'Conhece e respeita as normas de segurança e faz uso adequado dos EPIs.'],
            ['type_question_id' => 12
                , 'level' => 1
                , 'order' => 12
                , 'question_description' => 'Cumpre a jornada de trabalho, sem faltas, atrasos e ausencias do posto de trabalho. É comprometido em estar e ser
                presente.'],
        ];

        
        foreach ($questions1 as $question) {
           
            Question::create(
                $question
            );
        }
    } 

    public function textoAleatorio($numWords = 5) : string 
    {

        $text = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean ac ligula et ex elementum facilisis sit amet in tortor. Morbi ultrices euismod dolor, sed pharetra tortor congue vel. Donec dignissim leo eu lobortis facilisis. Vestibulum facilisis lobortis ante a vestibulum. Proin lobortis dolor risus, rutrum cursus metus vulputate nec. In tincidunt sapien non semper tincidunt. Ut non purus id lacus tempor pulvinar nec id tellus. Integer tempor risus in leo pretium, vitae consequat velit cursus. Sed mollis mauris ac varius sollicitudin.
        Aenean quam lectus, faucibus et est sed, luctus viverra lacus. Integer vitae dictum dolor. Proin pretium, ipsum id luctus interdum, diam mauris egestas ex, sed auctor felis magna eget est. Fusce cursus ultrices quam sed vestibulum. Donec lacinia vitae sapien a imperdiet. Aliquam at rutrum sapien. Curabitur et ipsum turpis. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. In fermentum leo ac turpis convallis, euismod dictum enim hendrerit. Cras vehicula nunc at nisi tempus, non iaculis dolor suscipit. Pellentesque mollis est a est dictum, varius maximus tellus facilisis.
        Praesent blandit eros mauris, in pharetra sem efficitur vitae. Nunc sit amet turpis nunc. Phasellus faucibus quis massa vitae gravida. Vestibulum fermentum, mauris sed bibendum mollis, nulla quam euismod arcu, eget sodales massa diam non arcu. Nam gravida, mi sed pretium tempor, nunc quam aliquet purus, sit amet efficitur est nisl eget sem. Etiam id laoreet metus. Donec commodo, elit sit amet commodo pretium, risus ex fringilla arcu, varius fringilla lectus velit ac lorem.";

        // Divide o texto em palavras usando espaços como delimitador
        $words = preg_split('/\s+/', $text, -1, PREG_SPLIT_NO_EMPTY);

        // Embaralha as palavras para obter uma seleção aleatória
        shuffle($words);

        // Seleciona um número específico de palavras aleatórias, definido por $numWords
        $randomWords = array_slice($words, 0, $numWords);

        // Concatena as palavras selecionadas em uma única string
        $randomText = implode(' ', $randomWords);

        return $randomText;

    }
    

}
