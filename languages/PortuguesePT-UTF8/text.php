<?php
switch ( $textpart ) {
	//browsesources.php, showsource.php
	case "sources":
		$text['browseallsources'] = "Ver todas as fontes";
		$text['shorttitle'] = "Título abreviado";
		$text['callnum'] = "Número de registo";
		$text['author'] = "Autor";
		$text['publisher'] = "Editor";
		$text['other'] = "Informações adicionais";
		$text['sourceid'] = "ID da Fonte";
		$text['moresrc'] = "Outras fontes";
		$text['repoid'] = "ID do Repositório";
		$text['browseallrepos'] = "Ver todos os repositórios";
		break;

	//changelanguage.php, savelanguage.php
	case "language":
		$text['newlanguage'] = "Novo idioma";
		$text['changelanguage'] = "Mudar de idioma";
		$text['languagesaved'] = "Idioma gravado";
		$text['sitemaint'] = "Site em manutenção";
		$text['standby'] = "O site está temporariamente fora do ar para manutenção da base de dados. Por favor, tente novamente depois de alguns minutos. Se o site permanecer em baixo por um período mais longo, por favor <a href=\"suggest.php\">contacte o proprietário do site</a>.";
		break;

	//gedcom.php, gedform.php
	case "gedcom":
		$text['gedstart'] = "GEDCOM a partir de";
		$text['producegedfrom'] = "Gerar ficheiro GEDCOM contendo";
		$text['numgens'] = "Número de gerações";
		$text['includelds'] = "Incluir informações SUD";
		$text['buildged'] = "Gerar GEDCOM";
		$text['gedstartfrom'] = "GEDCOM inicia a partir de";
		$text['nomaxgen'] = "Deve indicar o número máximo de gerações. Por favor, clique no botão 'Voltar' para regressar à página anterior e corrija o erro.";
		$text['gedcreatedfrom'] = "GEDCOM criado a partir de";
		$text['gedcreatedfor'] = "Gerado para";
		$text['creategedfor'] = "Gerar ficheiro GEDCOM";
		$text['email'] = "O seu e-mail";
		$text['suggestchange'] = "Sugestão de alteração para";
		$text['yourname'] = "O seu nome";
		$text['comments'] = "Descrição das<br />alterações propostas";
		$text['comments2'] = "Comentários";
		$text['submitsugg'] = "Submeter a sugestão";
		$text['proposed'] = "Alteração proposta";
		$text['mailsent'] = "Obrigado. A sua mensagem foi enviada.";
		$text['mailnotsent'] = "Lamentamos, mas a sua mensagem não pôde ser enviada. Por favor, contacte xxx directamente através de yyy.";
		$text['mailme'] = "Enviar uma cópia para este endereço";
		$text['entername'] = "Por favor, indique o seu nome";
		$text['entercomments'] = "Por favor, escreva os seus comentários";
		$text['sendmsg'] = "Enviar mensagem";
		//added in 9.0.0
		$text['subject'] = "Assunto";
		break;

	//getextras.php, getperson.php
	case "getperson":
		$text['photoshistoriesfor'] = "Fotografias e Histórias para ";
		$text['indinfofor'] = "Informações individuais sobre";
		$text['pp'] = "pg."; //page abbreviation
		$text['age'] = "Idade";
		$text['agency'] = "Órgão/repartição";
		$text['cause'] = "Causa";
		$text['suggested'] = "Alteração sugerida";
		$text['closewindow'] = "Fechar a janela";
		$text['thanks'] = "Obrigado";
		$text['received'] = "A sua sugestão foi enviada ao Administrador.";
		$text['indreport'] = "Relatório Individual";
		$text['indreportfor'] = "Relatório Individual para";
		$text['bkmkvis'] = "<strong>Nota:</strong> Estes marcadores apenas são visíveis neste computador e neste navegador.";
        //added in 9.0.0
		$text['reviewmsg'] = "Tem alterações sugeridas que exigem a sua revisão, relativas a:";
        $text['revsubject'] = "Alterações sugeridas requerem a sua revisão";
        break;

	//relateform.php, relationship.php, findpersonform.php, findperson.php
	case "relate":
	case "connections":
		$text['relcalc'] = "Calcular relações de parentesco";
		$text['findrel'] = "Encontrar parentesco";
		$text['person1'] = "Pessoa 1:";
		$text['person2'] = "Pessoa 2:";
		$text['calculate'] = "Calcular";
		$text['select2inds'] = "Por favor, seleccione dois indivíduos.";
		$text['findpersonid'] = "Encontrar ID de pessoa";
		$text['enternamepart'] = "Indique uma parte do nome ou do apelido";
		$text['pleasenamepart'] = "Por favor, indique uma parte de um nome ou apelido.";
		$text['clicktoselect'] = "Clique para seleccionar";
		$text['nobirthinfo'] = "Não existe informação de nascimento";
		$text['relateto'] = "Parentesco com ";
		$text['sameperson'] = "Os dois indivíduos são a mesma pessoa.";
		$text['notrelated'] = "As duas pessoas não têm qualquer parentesco entre si em xxx gerações."; //xxx will be replaced with number of generations
		$text['findrelinstr'] = "Para mostrar o parentesco entre duas pessoas, use os botões 'Pesquisar' abaixo para localizar os indivíduos (ou utilize as pessoas mostradas), e depois clique no botão 'Calcular'.";
		$text['sometimes'] = "(Por vezes, pesquisar num número diferente de gerações pode dar um resultado diferente.)";
		$text['findanother'] = "Encontrar outro parentesco";
		$text['brother'] = "irmão de";
		$text['sister'] = "irmã de";
		$text['sibling'] = "irmão/irmã de";
		$text['uncle'] = "xxx tio de";
		$text['aunt'] = "xxx tia de";
		$text['uncleaunt'] = "xxx tio/tia de";
		$text['nephew'] = "xxx sobrinho de";
		$text['niece'] = "xxx sobrinha de";
		$text['nephnc'] = "xxx sobrinho/sobrinha de";
		$text['removed'] = "(grau)";
		$text['rhusband'] = "marido de ";
		$text['rwife'] = "esposa de ";
		$text['rspouse'] = "cônjuge de ";
		$text['son'] = "filho de";
		$text['daughter'] = "filha de";
		$text['rchild'] = "filho/filha de";
		$text['sil'] = "genro de";
		$text['dil'] = "nora de";
		$text['sdil'] = "genro/nora de";
		$text['gson'] = "xxxneto de";
		$text['gdau'] = "xxxneta de";
		$text['gsondau'] = "xxxneto/xxxneta de";
		$text['great'] = "bis";
		$text['spouses'] = "são cônjuges";
		$text['is'] = "é";
		$text['changeto'] = "Mudar para (indicar o ID):";
		$text['notvalid'] = "não é um ID válido de pessoa ou não existe nesta base de dados. Por favor, tente novamente.";
		$text['halfbrother'] = "meio-irmão de";
		$text['halfsister'] = "meia-irmã de";
		$text['halfsibling'] = "meio-irmão de";
		//changed in 8.0.0
		$text['gencheck'] = "Número máximo de<br />gerações a considerar";
		$text['mcousin'] = "xxx primo em yyyº grau de";  //male cousin; xxx = cousin number, yyy = times removed
		$text['fcousin'] = "xxx prima em yyyº grau de";  //female cousin
		$text['cousin'] = "xxx primo/prima em yyyº grau de";
		$text['mhalfcousin'] = "xxx meio-primo em yyyº grau de";  //male cousin
		$text['fhalfcousin'] = "xxx meia-prima em yyyº grau de";  //female cousin
		$text['halfcousin'] = "xxx meio-primo em yyyº grau de";
		//added in 8.0.0
		$text['oneremoved'] = "afastado uma vez";
		$text['gfath'] = "xxxavô de";
		$text['gmoth'] = "xxxavó de";
		$text['gpar'] = "xxxavô/xxxavó de";
		$text['mothof'] = "a mãe de";
		$text['fathof'] = "o pai de";
		$text['parof'] = "progenitor de";
		$text['maxrels'] = "Número máximo de parentescos a mostrar";
		$text['dospouses'] = "Mostrar parentescos envolvendo o cônjuge";
		$text['rels'] = "Parentescos";
		$text['dospouses2'] = "Mostrar cônjuges";
		$text['fil'] = "sogro de";
		$text['mil'] = "sogra de";
		$text['fmil'] = "sogro/sogra de";
		$text['stepson'] = "enteado de";
		$text['stepdau'] = "enteada de";
		$text['stepchild'] = "enteado/enteada de";
		$text['stepgson'] = "enteado-xxxneto de";
		$text['stepgdau'] = "enteada-xxxneta de";
		$text['stepgchild'] = "enteado-xxxneto/enteada-xxxneta de";
		//added in 8.1.1
		$text['ggreat'] = "tris";
		//added in 8.1.2
		$text['ggfath'] = "bisavô de";
		$text['ggmoth'] = "bisavó de";
		$text['ggpar'] = "bisavô/bisavó de";
		$text['ggson'] = "bisneto de";
		$text['ggdau'] = "bisneta de";
		$text['ggsondau'] = "bisneto/bisneta de";
		$text['gstepgson'] = "enteado-bisneto de";
		$text['gstepgdau'] = "enteada-bisneta de";
		$text['gstepgchild'] = "enteado-bisneto/enteada-bisneta de";
		$text['guncle'] = "tio-avô de";
		$text['gaunt'] = "tia-avó de";
		$text['guncleaunt'] = "tio-avô/tia-avó de";
		$text['gnephew'] = "sobrinho-neto de";
		$text['gniece'] = "sobrinha-neta de";
		$text['gnephnc'] = "sobrinho-neto/sobrinha-neta de";
		//added in 14.0
		$text['pathscalc'] = "Pesquisar ligações";
		$text['findrel2'] = "Encontrar relacionamentos e outras ligações";
		$text['makeme2nd'] = "Usar o meu ID";
		$text['usebookmarks'] = "Usar marcadores";
		$text['select2inds'] = "Por favor, seleccione dois indivíduos.";
		$text['indinfofor'] = "Informação individual para";
		$text['nobookmarks'] = "Não existe nenhum marcador para usar";
		$text['bkmtitle'] = "Pessoas encontradas em marcadores";
		$text['bkminfo'] = "Seleccione uma pessoa:";
		$text['sortpathsby'] = "Ordenar os caminhos por número de";
		$text['sortbyshort'] = "Ordenar por";
		$text['bylengthshort'] = "Comprimento";
		$text['badID1'] = ": ID da pessoa 1 incorrecto - por favor, volte atrás e corrija";
		$text['badID2'] = ": ID da pessoa 2 incorrecto - por favor, volte atrás e corrija";
		$text['notintree'] = ": a pessoa com este ID não está na base de dados da corrente árvore.";
		$text['sameperson'] = "Os dois indivíduos são a mesma pessoa.";;
		$text['nopaths'] = "Estas pessoas não têm qualquer ligação entre si.";
		$text['nopaths1'] = "Não existem mais ligações com menos de xxx passos";
		$text['nopaths2'] = "em xxx passos de pesquisa";
		$text['longestpath'] = "(o caminho mais longo pesquisado tem xxx passos)";
		$text['relevantpaths'] = "Número de caminhos únicos relevantes encontrados: xxx";
		$text['skipMarr'] = "(adicionalmente, o número de caminhos encontrados mas não mostrados devido a um número excessivo de casamentos foi: xxx)";
		$text['mjaor'] = "ou";
		$text['connectionsto'] = "Ligações a ";
		$text['findanotherpers'] = "Encontrar outra pessoa...";
		$text['sometimes'] = "(Por vezes, pesquisar num número diferente de gerações pode dar um resultado diferente.)";
		$text['anotherpath'] = "Pesquisar outras ligações";
		$text['xpath'] = "Caminho ";
		$text['primary'] = "Pessoa Inicial"; // note: used for both Start and End if text['fin'] not set
		$text['secondary'] = "Pessoa Final";
		$text['parent'] = "Progenitor";
		$text['mhfather'] = "seu pai";
		$text['mhmother'] = "sua mãe";
		$text['mhhusband'] = "seu marido";
		$text['mhwife'] = "sua mulher";
		$text['mhson'] = "seu filho";
		$text['mhdaughter'] = "sua filha";
		$text['fhfather'] = "seu pai";
		$text['fhmother'] = "sua mãe";
		$text['fhhusband'] = "seu marido";
		$text['fhwife'] = "sua mulher";
		$text['fhson'] = "seu filho";
		$text['fhdaughter'] = "sua filha";
		$text['hfather'] = "pai";
		$text['hmother'] = "mãe";
		$text['hhusband'] = "marido";
		$text['hwife'] = "mulher";
		$text['hson'] = "filho";
		$text['hdaughter'] = "filha";
		$text['maxruns'] = "Número máximo de caminhos a verificar";
		$text['maxrshort'] = "Nº máximo de caminhos";
		$text['maxlength'] = "Caminhos de ligação menores que";
		$text['maxlshort'] = "Comprimento máximo";
		$text['xstep'] = "passo";
		$text['xsteps'] = "passos";
		$text['xmarriages'] = "xxx casamentos";
		$text['xmarriage'] = "1 casamento";
		$text['showspouses'] = "Mostrar ambos os cônjuges";
		$text['showTxt'] = "Mostrar literalmente a descrição do caminho";
		$text['showTxtshort'] = "Desc. literal";
		$text['compactBox'] = "Mostrar as caixas de indivíduo em forma compacta";
		$text['compactBoxshort'] = "Caixas compactas";
		$text['paths'] = "Caminhos";
		$text['dospouses2'] = "Mostrar cônjuges";
		$text['maxmopt'] = "N. máx. casamentos por ligação";
		$text['maxm'] = "N. máx. casamentos";
		$text['arerelated'] = "Estas pessoas são parentes - o seu relacionamento mostra-se no Caminho 1";
		$text['simplerel'] = "Pesquisa simples de relacionamento";
		break;

	case "familygroup":
		$text['familygroupfor'] = "Ficha Familiar para ";
		$text['ldsords'] = "Informações SUD";
		$text['baptizedlds'] = "Baptismo (SUD)";
		$text['endowedlds'] = "Investidura (SUD)";
		$text['sealedplds'] = "Selamento aos pais (SUD)";
		$text['sealedslds'] = "Selamento ao cônjuge (SUD)";
		$text['otherspouse'] = "Outros cônjuges";
		$text['husband'] = "Marido";
		$text['wife'] = "Mulher";
		break;

	//pedigree.php
	case "pedigree":
		$text['capbirthabbr'] = "N";
		$text['capaltbirthabbr'] = "N";
		$text['capdeathabbr'] = "F";
		$text['capburialabbr'] = "S";
		$text['capplaceabbr'] = "L";
		$text['capmarrabbr'] = "C";
		$text['capspouseabbr'] = "M";
		$text['redraw'] = "Reapresentar com ";
		$text['unknownlit'] = "Desconhecido";
		$text['popupnote1'] = " = Informação adicional";
		$text['pedcompact'] = "Compacta";
		$text['pedstandard'] = "Padrão";
		$text['pedtextonly'] = "Textual";
		$text['descendfor'] = "Descendentes de ";
		$text['maxof'] = "Mostrar no máximo";
		$text['gensatonce'] = "gerações ao mesmo tempo.";
		$text['sonof'] = "filho de";
		$text['daughterof'] = "filha de";
		$text['childof'] = "filho(a) de";
		$text['stdformat'] = "Formato Padrão";
		$text['ahnentafel'] = "Árvore de Costado (Ahnentafel)";
		$text['addnewfam'] = "Adicionar nova família";
		$text['editfam'] = "Alterar família";
		$text['side'] = "(lado dos)";
		$text['familyof'] = "Família de";
		$text['paternal'] = "lado Paterno";
		$text['maternal'] = "lado Materno";
		$text['gen1'] = "Próprio";
		$text['gen2'] = "Pais";
		$text['gen3'] = "Avós";
		$text['gen4'] = "Bisavós";
		$text['gen5'] = "Tetravós";
		$text['gen6'] = "5.os avós";
		$text['gen7'] = "6.os avós";
		$text['gen8'] = "7.os avós";
		$text['gen9'] = "8.os avós";
		$text['gen10'] = "9.os avós";
		$text['gen11'] = "10.os avós";
		$text['gen12'] = "11.os avós";
		$text['graphdesc'] = "Gráfico de Descendência até este ponto";
		$text['pedbox'] = "Caixa";
		$text['regformat'] = "Formato de Registo";
		$text['extrasexpl'] = "Existe pelo menos uma fotografia, história ou outro item de media para esta pessoa.";
		$text['popupnote3'] = " = Novo gráfico";
		$text['mediaavail'] = "Media disponível";
		$text['pedigreefor'] = "Árvore de Costado para";
		$text['pedigreech'] = "Árvore de Costado";
		$text['datesloc'] = "Datas e Locais";
		$text['borchr'] = "Nasc./Bap. – Falec./Sepult.";
		$text['nobd'] = "Sem datas de nascimento ou óbito";
		$text['bcdb'] = " Nasc./Bap./Falec./Sepult.";
		$text['numsys'] = "Sistema de Numeração";
		$text['gennums'] = "Números de Geração";
		$text['henrynums'] = "Números Henry";
		$text['abovnums'] = " Números d'Aboville";
		$text['devnums'] = " Números de Villiers";
		$text['dispopts'] = "Opções de Visualização";
		//added in 10.0.0
		$text['no_ancestors'] = "Não foram encontrados antepassados";
		$text['ancestor_chart'] = "Diagrama vertical de antepassados";
		$text['opennewwindow'] = "Abrir numa nova janela";
		$text['pedvertical'] = "Vertical";
		//added in 11.0.0
		$text['familywith'] = "Família com";
		$text['fcmlogin'] = "Por favor, faça login para ver mais pormenores";
		$text['isthe'] = "é o";
		$text['otherspouses'] = "outras esposas";
		$text['parentfamily'] = "A família dos pais é ";
		$text['showfamily'] = "Mostrar a família";
		$text['shown'] = "mostrado";
		$text['showparentfamily'] = "mostrar família dos pais";
		$text['showperson'] = "mostrar pessoa";
		//added in 11.0.2
		$text['otherfamilies'] = "Outras famílias";
		//added in 14.0
		$text['dtformat'] = "Tabelas";
		$text['dtchildren'] = "Filhos";
		$text['dtgrandchildren'] = "Netos";
		$text['dtggrandchildren'] = "Bisnetos";
		$text['dtgggrandchildren'] = "Bisnetos"; //For 2x great grandchildren, 3x great grandchildren, etc. Usually different in Scandinavian languages
		$text['greatoffset'] = "0"; //Scandinavian languages should set this to 1 so counting starts a generation later
		$text['dtnodescendants'] = "Sem descendência";
		$text['dtgen'] = "Ger.";
		$text['dttotal'] = "Total";
		$text['dtselect'] = "Seleccione";
		$text['dteachfulltable'] = "Cada tabela completa terá";
		$text['dtrows'] = "linhas";
		$text['dtdisplayingtable'] = "A mostrar a tabela";
		$text['dtgototable'] = "Ir para a tabela:";
		$text['fcinstrdn'] = "Mostrar a família com o cônjuge";
		$text['fcinstrup'] = "Mostrar a família com os progenitores";
		$text['fcinstrplus'] = "Seleccionar outros cônjuges";
		$text['fcinstrfam'] = "Seleccionar outros progenitores";
		break;

	//search.php, searchform.php
	//merged with reports and showreport in 5.0.0
	case "search":
	case "reports":
		$text['noreports'] = "Não existem relatórios.";
		$text['reportname'] = "Nome do Relatório";
		$text['allreports'] = "Todos os Relatórios";
		$text['report'] = "Relatório";
		$text['error'] = "Erro";
		$text['reportsyntax'] = "A síntaxe da consulta referente a este relatório é";
		$text['wasincorrect'] = "inválida. O relatório não pôde ser criado. Por favor, comunique com o responsável pelo sistema através de";
		$text['errormessage'] = "Mensagem de erro";
		$text['equals'] = "igual a";
		$text['endswith'] = "termina com";
		$text['soundexof'] = "soundex de";
		$text['metaphoneof'] = "metafon de";
		$text['plusminus10'] = "+/- 10 anos de";
		$text['lessthan'] = "menor que";
		$text['greaterthan'] = "maior que";
		$text['lessthanequal'] = "menor ou igual a";
		$text['greaterthanequal'] = "maior ou igual a";
		$text['equalto'] = "igual a";
		$text['tryagain'] = "Por favor, tente novamente";
		$text['joinwith'] = "Conector lógico";
		$text['cap_and'] = "E";
		$text['cap_or'] = "OU";
		$text['showspouse'] = "Mostrar o cônjuge (se existirem vários cônjuges, serão mostrados duplicados)";
		$text['submitquery'] = "Pesquisar";
		$text['birthplace'] = "Local de Nascimento";
		$text['deathplace'] = "Local de Óbito";
		$text['birthdatetr'] = "Ano de Nascimento";
		$text['deathdatetr'] = "Ano de Óbito";
		$text['plusminus2'] = "+/- 2 anos desde";
		$text['resetall'] = "Limpar todos os valores";
		$text['showdeath'] = "Mostrar informações de óbito/inumação";
		$text['altbirthplace'] = "Local do Baptismo";
		$text['altbirthdatetr'] = "Ano do Baptismo";
		$text['burialplace'] = "Local da Inumação";
		$text['burialdatetr'] = "Ano da Inumação";
		$text['event'] = "Evento(s)";
		$text['day'] = "Dia";
		$text['month'] = "Mês";
		$text['keyword'] = "Palavra-chave (p.ex.: \"ABT\", \"BEF\", \"AFT\")";
		$text['explain'] = "Escrever a data (ou parte dela) para obter os eventos correspondentes. Deixar em branco para obter todos.";
		$text['enterdate'] = "Por favor, indique ou seleccione pelo menos um dos seguintes: Dia, Mês, Ano ou Palavra-chave";
		$text['fullname'] = "Nome Completo";
		$text['birthdate'] = "Data de Nascimento";
		$text['altbirthdate'] = "Data do Baptismo";
		$text['marrdate'] = "Data do Casamento";
		$text['spouseid'] = "ID do Cônjuge";
		$text['spousename'] = "Nome do Cônjuge";
		$text['deathdate'] = "Data do Óbito";
		$text['burialdate'] = "Data da Inumação";
		$text['changedate'] = "Data da última alteração";
		$text['gedcom'] = "Árvore";
		$text['baptdate'] = "Data do baptismo (SUD)";
		$text['baptplace'] = "Local do baptismo (SUD)";
		$text['endldate'] = "Data da Investidura (SUD)";
		$text['endlplace'] = "Local da Investidura (SUD)";
		$text['ssealdate'] = "Data do Selamento ao Cônjuge (SUD)";   //Sealed to spouse
		$text['ssealplace'] = "Local do Selamento ao Cônjuge (SUD)";
		$text['psealdate'] = "Data do Selamento aos Pais (SUD)";   //Sealed to parents
		$text['psealplace'] = "Local do Selamento aos Pais (SUD)";
		$text['marrplace'] = "Local do Casamento";
		$text['spousesurname'] = "Apelido do cônjuge";
		$text['spousemore'] = "Se preencher o apelido do cônjuge, deverá seleccionar o Sexo.";
		$text['plusminus5'] = "+/- 5 anos desde";
		$text['exists'] = "existe";
		$text['dnexist'] = "não existe";
		$text['divdate'] = "Data do Divórcio";
		$text['divplace'] = "Local do Divórcio";
		$text['otherevents'] = "Outros critérios de pesquisa";
		$text['numresults'] = "Resultados por Página";
		$text['mysphoto'] = "Fotos Procuradas";
		$text['mysperson'] = "Pessoas Procuradas";
		$text['joinor'] = "A opção 'Junção com OU' não pode ser usada com o Apelido da Esposa";
		$text['tellus'] = "Conte-nos aquilo que sabe";
		$text['moreinfo'] = "Mais informações:";
		//added in 8.0.0
		$text['marrdatetr'] = "Ano do Casamento";
		$text['divdatetr'] = "Ano do Divórcio";
		$text['mothername'] = "Nome da Mãe";
		$text['fathername'] = "Nome do Pai";
		$text['filter'] = "Filtro";
		$text['notliving'] = "Falecido";
		$text['nodayevents'] = "Eventos deste mês que não estão associados a um dia específico";
		//added in 9.0.0
		$text['csv'] = "Ficheiro CSV";
		//added in 10.0.0
		$text['confdate'] = "Data de confirmação - SUD";
		$text['confplace'] = "Local de confirmação - SUD";
		$text['initdate'] = "Data de iniciação - SUD";
		$text['initplace'] = "Local de iniciação - SUD";
		//added in 11.0.0
		$text['marrtype'] = "Tipo de Casamento";
		$text['searchfor'] = "Pesquisar por";
		$text['searchnote'] = "Nota: Esta pesquisa é realizada usando o Google. O número de respostas depende da quantidade de páginas do site que o Google conseguiu indexar.";
		break;

	//showlog.php
	case "showlog":
		$text['logfilefor'] = "Ficheiro de log para";
		$text['mostrecentactions'] = "Acções mais recentes";
		$text['autorefresh'] = "Actualização automática (a cada 30 segundos)";
		$text['refreshoff'] = "Desligar a actualização automática";
		break;

	case "headstones":
	case "showphoto":
		$text['cemeteriesheadstones'] = "Cemitérios e Lápides";
		$text['showallhsr'] = "Mostrar todas as lápides";
		$text['in'] = "em";
		$text['showmap'] = "Mostrar o mapa";
		$text['headstonefor'] = "Lápide de";
		$text['photoof'] = "Fotografia de";
		$text['photoowner'] = "Proprietário/fonte do original";
		$text['nocemetery'] = "Sem cemitério";
		$text['iptc005'] = "Título";
		$text['iptc020'] = "Categorias adicionais";
		$text['iptc040'] = "Instruções especiais";
		$text['iptc055'] = "Data de criação";
		$text['iptc080'] = "Autor";
		$text['iptc085'] = "Função do autor";
		$text['iptc090'] = "Cidade";
		$text['iptc095'] = "Estado";
		$text['iptc101'] = "País";
		$text['iptc103'] = "OTR";
		$text['iptc105'] = "Cabeçalho";
		$text['iptc110'] = "Fonte";
		$text['iptc115'] = "Fonte das Fotografias";
		$text['iptc116'] = "Direitos de Autor";
		$text['iptc120'] = "Legenda";
		$text['iptc122'] = "Autor da legenda";
		$text['mapof'] = "Mapa de";
		$text['regphotos'] = "Ver miniaturas e texto";
		$text['gallery'] = "Apenas miniaturas";
		$text['cemphotos'] = "Fotos de cemitérios";
		$text['photosize'] = "Dimensões";
        $text['iptc010'] = "Prioridade";
		$text['filesize'] = "Tamanho do ficheiro";
		$text['seeloc'] = "Ver localização";
		$text['showall'] = "Mostrar tudo";
		$text['editmedia'] = "Editar media";
		$text['viewitem'] = "Ver este item";
		$text['editcem'] = "Editar Cemitério";
		$text['numitems'] = "Nº de Itens";
		$text['allalbums'] = "Todos os álbuns";
		$text['slidestop'] = "Suspender a apresentação";
		$text['slideresume'] = "Retomar a apresentação";
		$text['slidesecs'] = "Segundos por slide:";
		$text['minussecs'] = "menos 0.5 segundo";
		$text['plussecs'] = "mais 0.5 segundo";
		$text['nocountry'] = "País desconhecido";
		$text['nostate'] = "Estado desconhecido";
		$text['nocounty'] = "Concelho/Província desconhecido";
		$text['nocity'] = "Cidade desconhecida";
		$text['nocemname'] = "Nome de cemitério desconhecido";
		$text['editalbum'] = "Editar Álbum";
		$text['mediamaptext'] = "<strong>Nota:</strong> Mova o cursor do rato sobre a imagem para mostrar os nomes. Clique para ver a página correspondente a esse nome.";
		//added in 8.0.0
		$text['allburials'] = "Todas as Inumações";
		$text['moreinfo'] = "Clique para obter mais informações sobre esta imagem";
		//added in 9.0.0
        $text['iptc025'] = "Palavras-chave";
        $text['iptc092'] = "Sub-local";
		$text['iptc015'] = "Categoria";
		$text['iptc065'] = "Programa de origem";
		$text['iptc070'] = "Versão do programa";
		//added in 13.0
		$text['toggletags'] = "Alternar Etiquetas";
		break;

	//surnames.php, surnames100.php, surnames-all.php, surnames-oneletter.php
	case "surnames":
	case "places":
		$text['surnamesstarting'] = "Mostrar apelidos que começam com a letra";
		$text['showtop'] = "Mostrar os primeiros";
		$text['showallsurnames'] = "Mostrar todos os apelidos";
		$text['sortedalpha'] = "por ordem alfabética";
		$text['byoccurrence'] = "por ordem de ocorrência";
		$text['firstchars'] = "Primeiras letras";
		$text['mainsurnamepage'] = "Página inicial de apelidos";
		$text['allsurnames'] = "Todos os apelidos";
		$text['showmatchingsurnames'] = "Clique num apelido para mostrar os registos correspondentes";
		$text['backtotop'] = "Voltar para o topo";
		$text['beginswith'] = "Começa por";
		$text['allbeginningwith'] = "Todos os apelidos que começam com a letra";
		$text['numoccurrences'] = "número de ocorrências entre parênteses";
		$text['placesstarting'] = "Mostrar os principais Locais que começam pela letra";
		$text['showmatchingplaces'] = "Clique num Local para mostrar Locais menores. Clique na pequena lupa para mostrar as pessoas correspondentes.";
		$text['totalnames'] = "total de pessoas";
		$text['showallplaces'] = "Mostrar todos os locais principais";
		$text['totalplaces'] = "total de locais";
		$text['mainplacepage'] = "Página principal de Locais";
		$text['allplaces'] = "Todos os Locais Principais";
		$text['placescont'] = "Mostar todos os Locais que contêm";
		//changed in 8.0.0
		$text['top30'] = "xxx apelidos mais frequentes";
		$text['top30places'] = "xxx Locais com mais indivíduos";
		//added in 12.0.0
		$text['firstnamelist'] = "Lista de Nomes Próprios";
		$text['firstnamesstarting'] = "Mostrar os nomes próprios começados por";
		$text['showallfirstnames'] = "Mostrar todos os nomes próprios";
		$text['mainfirstnamepage'] = "Página principal de nomes próprios";
		$text['allfirstnames'] = "Todos os nomes próprios";
		$text['showmatchingfirstnames'] = "Clique num nome próprio para mostrar os registos correspondentes.";
		$text['allfirstbegwith'] = "Todos os nomes próprios começados por";
		$text['top30first'] = "Primeiros xxx nomes próprios";
		$text['allothers'] = "Todos os outros";
		$text['amongall'] = "(entre todos os nomes)";
		$text['justtop'] = "Apenas os primeiros xxx";
		break;

	//whatsnew.php
	case "whatsnew":
		$text['pastxdays'] = "(últimos xx dias)";

		$text['photo'] = "Fotografias";
		$text['history'] = "Histórias/Documentos";
		$text['husbid'] = " ID do Marido";
		$text['husbname'] = "Nome do Marido";
		$text['wifeid'] = " ID da Mulher";
		//added in 11.0.0
		$text['wifename'] = "Nome da Mulher";
		break;

	//timeline.php, timeline2.php
	case "timeline":
		$text['text_delete'] = "Eliminar";
		$text['addperson'] = "Adicionar pessoa";
		$text['nobirth'] = "A pessoa que indicou não tem uma data de nascimento válida, pelo que não é possível adicioná-la à cronologia";
		$text['event'] = "Evento(s)";
		$text['chartwidth'] = "Largura do diagrama";
		$text['timelineinstr'] = "Adicionar pessoas";
		$text['togglelines'] = "Trocar linhas";
		//changed in 9.0.0
		$text['noliving'] = "A pessoa que indicou está marcada cpmo 'viva' ou 'privada' e não pôde ser adicionada à cronologia porque não está identificado no site com as permissões adequadas";
		break;
		
	//browsetrees.php
	//login.php, newacctform.php, addnewacct.php
	case "trees":
	case "login":
		$text['browsealltrees'] = "Ver todas as árvores";
		$text['treename'] = "Nome da Árvore";
		$text['owner'] = "Proprietário";
		$text['address'] = "Endereço";
		$text['city'] = "Cidade";
		$text['state'] = "Estado";
		$text['zip'] = "CEP/Código Postal";
		$text['country'] = "País";
		$text['email'] = "E-mail";
		$text['phone'] = "Telefone";
		$text['username'] = "Nome de Utilizador";
		$text['password'] = "Password";
		$text['loginfailed'] = "O login falhou.";

		$text['regnewacct'] = "Solicitar registo como utilizador";
		$text['realname'] = "Nome real";
		$text['phone'] = "Telefone";
		$text['email'] = "E-mail";
		$text['address'] = "Endereço";
		$text['acctcomments'] = "Notas ou Comentários";
		$text['submit'] = "Submeter";
		$text['leaveblank'] = "(deixar em branco se solicitar uma nova árvore)";
		$text['required'] = "Campos obrigatórios";
		$text['enterpassword'] = "Por favor, indique uma password.";
		$text['enterusername'] = "Por favor, indique um nome de utilizador.";
		$text['failure'] = "Lamentamos, mas o Nome de Utilizador que indicou já existe. Por favor, volte à página anterior usando o botão 'Voltar' do seu browser e indique um nome de utilizador diferente.";
		$text['success'] = "Obrigado. A sua solicitação de registo foi recebida correctamente. Entraremos em contacto consigo quando a sua conta estiver activa ou se necessitarmos mais informações.";
		$text['emailsubject'] = "Solicitação de registo de novo utilizador TNG";
		$text['website'] = "Página Web (endereço WWW)";
		$text['nologin'] = "Não tem password?";
		$text['loginsent'] = "A sua informação de utilizador foi enviada";
		$text['loginnotsent'] = "A informação de utilizador não foi enviada";
		$text['enterrealname'] = "Por favor, indique o seu nome real.";
		$text['rempass'] = "Permanecer ligado neste computador";
		$text['morestats'] = "Mais estatísticas";
		$text['accmail'] = "<strong>NOTA:</strong> Para garantir que recebe o e-mail do Administrador deste site relativo à sua conta, por favor assegure-se de que o seu servidor de e-mail não bloqueia e-mails enviados deste domínio.";
		$text['newpassword'] = "Nova password";
		$text['resetpass'] = "Criar uma nova password";
		$text['nousers'] = "Este formulário não pode ser usado enquanto não existir pelo menos um utilizador registado. Se é o proprietário deste site, por favor crie a conta de utilizador em Administração/Utilizadores.";
		$text['noregs'] = "Lamentamos, mas não podemos aceitar novos utilizadores de momento. Por favor <a href=\"suggest.php\">contacte-nos</a> directamente se tiver comentários ou questões sobre este site.";
		$text['emailmsg'] = "Recebeu um pedido de registo de utilizador no TNG. Por favor, faça as devidas autorizações como Administrador do TNG. Caso concorde com o registo, por favor comunique-o ao solicitante através deste e-mail.";
		$text['accactive'] = "A conta foi activada, mas o utilizador não terá permissões especiais enquanto o administrador não as atribuir.";
		$text['accinactive'] = "Vá para Administração/Utilizadores/Revisão para aceder às propriedades da conta. A conta permanecerá inactiva até que a edite e grave pelo menos uma vez.";
		$text['pwdagain'] = "Repetição da password";
		$text['enterpassword2'] = "Por favor, introduza a password novamente.";
		$text['pwdsmatch'] = "As suas passwords não coincidem. Por favor introduza a mesma password em ambos os campos.";
		$text['acksubject'] = "Obrigado por se registar"; //for a new user account
		$text['ackmessage'] = "A sua solicitação de uma conta de utilizador foi recebida. A sua conta permanecerá inactiva até que seja revista pelo Administrador do site. Será notificado por e-mail assim que a solicitação for aprovada.";
		//added in 12.0.0
		$text['switch'] = "Switch";
		//added in 14.0
		$text['newpassword2'] = "Repita a nova password";
		$text['resetsuccess'] = "Sucesso: a password foi reiniciada";
		$text['resetfail'] = "Erro: a password NÃO FOI reiniciada";
		$text['failreason0'] = " (erro desconhecido na base de dados)";
		$text['failreason2'] = " (não tem permissão para alterar a sua password)";
		$text['failreason3'] = " (as passwords não coincidem)";
		break;

	//added in 10.0.0
	case "branches":
		$text['browseallbranches'] = "Ver todos os ramos";
		break;

	//statistics.php
	case "stats":
		$text['quantity'] = "Quantidade";
		$text['totindividuals'] = "Total de Pessoas";
		$text['totmales'] = "Total de Homens";
		$text['totfemales'] = "Total de Mulheres";
		$text['totunknown'] = "Total de Sexo Indeterminado";
		$text['totliving'] = "Total de Vivos";
		$text['totfamilies'] = "Total de Famílias";
		$text['totuniquesn'] = "Total de Nomes diferentes";
		//$text['totphotos'] = "Total Photos";
		//$text['totdocs'] = "Total Histories &amp; Documents";
		//$text['totheadstones'] = "Total Headstones";
		$text['totsources'] = "Total de Fontes";
		$text['avglifespan'] = "Tempo Médio de Vida";
		$text['earliestbirth'] = "Nascimento mais antigo";
		$text['longestlived'] = "Com maior longevidade";
		$text['days'] = "dias";
		$text['age'] = "Idade";
		$text['agedisclaimer'] = "Os cálculos relacionados com a idade baseiam-se nas pessoas com data de nascimento <em>e</em> data de óbito registadas. Em caso de preenchimento incompleto destes campos (por exemplo, uma data de nascimento ou óbito indicada apenas como \"1945\" ou \"antes de 1860\"), estes cálculos poderão não estar 100% correctos.";
		$text['treedetail'] = "Mais informações sobre esta árvore";
		$text['total'] = "Total de";
		//added in 12.0
		$text['totdeceased'] = "Total de Falecidos";
		//added in 14.0
		$text['totalsourcecitations'] = "Total de Citações de Fonte";
		break;

	case "notes":
		$text['browseallnotes'] = "Ver todas as notas";
		break;

	case "help":
		$text['menuhelp'] = "Significado dos ícones do menu";
		break;

	case "install":
		$text['perms'] = "As permissões foram todas atribuídas.";
		$text['noperms'] = "As permissões para estes ficheiros não puderam ser atribuídas:";
		$text['manual'] = "Por favor, atribua-as manualmente.";
		$text['folder'] = "Pasta";
		$text['created'] = "foi criada";
		$text['nocreate'] = "não pôde ser criada. Por favor, proceda à sua criação manualmente.";
		$text['infosaved'] = "Informação gravada, conexão verificada!";
		$text['tablescr'] = "As tabelas foram criadas!";
		$text['notables'] = "As tabelas a seguir não puderam ser criadas:";
		$text['nocomm'] = "O TNG não está a comunicar com o servidor de base de dados. Nenhuma tabela foi criada.";
		$text['newdb'] = "Informação gravada, conexão verificada, nova base de dados criada:";
		$text['noattach'] = "Informação gravada. Conexão feita e base de dados criada, mas o TNG não consegue acedê-la.";
		$text['nodb'] = "Informação gravada. Conexão feita, mas a base de dados não existe e não pôde ser criada. Por favor, verifique se o nome da base de dados é o correcto e que o utilizador da base de dados tem o acesso devido, ou use o seu painel de controle para a criar.";
		$text['noconn'] = "Informação gravada mas a conexão falhou. Um ou mais dos seguintes estão incorrectos:";
		$text['exists'] = "já existe.";
		$text['noop'] = "Não foi realizada qualquer acção.";
		//added in 8.0.0
		$text['nouser'] = "O utilizador não foi criado. Pode já existir este Nome de Utilizador.";
		$text['notree'] = "A árvore não foi criada. Pode já existir este ID de Árvore.";
		$text['infosaved2'] = "Informação gravada";
		$text['renamedto'] = "renomeada para";
		$text['norename'] = "não pôde ser renomeada";
		//changed in 13.0.0
		$text['loginfirst'] = "Já existem registos de utilizador. Para continuar deve primeiro fazer login ou remover todos os registos da tabela de utilizadores.";
		break;

	case "imgviewer":
		$text['magmode'] = "Modo de Ampliação";
		$text['panmode'] = "Modo de Varredura";
		$text['pan'] = "Se necessário, clique e arraste para mover a imagem dentro da janela";
		$text['fitwidth'] = "Ajustar à largura";
		$text['fitheight'] = "Ajustar à altura";
		$text['newwin'] = "Nova janela";
		$text['opennw'] = "Abrir a imagem numa nova janela";
		$text['magnifyreg'] = "Clique para ampliar uma parte da imagem";
		$text['imgctrls'] = "Habilitar controles da imagem";
		$text['vwrctrls'] = "Habilitar controles do visualizador de imagens";
		$text['vwrclose'] = "Fechar o visualizador de imagens";
		break;

	case "dna":
		$text['test_date'] = "Data do teste";
		$text['links'] = "Links relevantes";
		$text['testid'] = "ID do teste";
		//added in 12.0.0
		$text['mode_values'] = "Valores de Modo";
		$text['compareselected'] = "Comparar os Seleccionados";
		$text['dnatestscompare'] = "Comparar Testes de Y-DNA";
		$text['keep_name_private'] = "Manter o Nome Privado";
		$text['browsealltests'] = "Ver todos os testes";
		$text['all_dna_tests'] = "Todos os testes de ADN";
		$text['fastmutating'] = "Mutação Rápida";
		$text['alltypes'] = "Todos os Tipos";
		$text['allgroups'] = "Todos os Grupos";
		$text['Ydna_LITbox_info'] = "Os testes vinculados a esta pessoa não foram necessariamente feitos por esta pessoa.<br />A coluna 'Haplogrupo' mostra os dados em vermelho se o resultado for 'Previsto', e em verde se o teste for 'Confirmado'";
		//added in 12.1.0
		$text['dnatestscompare_mtdna'] = "Comparar Testes mtDNA";
		$text['dnatestscompare_atdna'] = "Comparar Testes atDNA";
		$text['chromosome'] = "Cr";
		$text['centiMorgans'] = "cM";
		$text['snps'] = "SNPs";
		$text['y_haplogroup'] = "Y-DNA";
		$text['mt_haplogroup'] = "mtDNA";
		$text['sequence'] = "Ref";
		$text['extra_mutations'] = "Mutações extra";
		$text['mrca'] = "MRC Ancestral";
		$text['ydna_test'] = "Testes Y-DNA";
		$text['mtdna_test'] = "Testes mtDNA (mitocondriais)";
		$text['atdna_test'] = "Testes atDNA (autossómicos)";
		$text['segment_start'] = "Início";
		$text['segment_end'] = "Fim";
		$text['suggested_relationship'] = "Sugerido";
		$text['actual_relationship'] = "Real";
		$text['12markers'] = "Marcadores 1-12";
		$text['25markers'] = "Marcadores 13-25";
		$text['37markers'] = "Marcadores 26-37";
		$text['67markers'] = "Marcadores 38-67";
		$text['111markers'] = "Marcadores 68-111";
		//added in 13.1
		$text['comparemore'] = "Devem ser seleccionados pelo menos dois testes para poder fazer a comparação.";
		break;
}

//common
$text['matches'] = "Resultados";
$text['description'] = "Descrição";
$text['notes'] = "Notas";
$text['status'] = "Status";
$text['newsearch'] = "Nova Consulta";
$text['pedigree'] = "Árvore genealógica";
$text['seephoto'] = "Ver a fotografia";
$text['andlocation'] = "e Local";
$text['accessedby'] = "acedido por";
$text['children'] = "Filhos";  //from getperson
$text['tree'] = "Árvore";
$text['alltrees'] = "Todas as árvores";
$text['nosurname'] = "[sem apelido]";
$text['thumb'] = "Miniat.";  //as in Thumbnail
$text['people'] = "Pessoas";
$text['title'] = "Título";  //from getperson
$text['suffix'] = "Sufixo";  //from getperson
$text['nickname'] = "Alcunha";  //from getperson
$text['lastmodified'] = "Última alteração";  //from getperson
$text['married'] = "Casamento";  //from getperson
//$text['photos'] = "Photos";
$text['name'] = "Nome"; //from showmap
$text['lastfirst'] = "Apelido, Nome";  //from search
$text['bornchr'] = "Nascimento/Baptismo";  //from search
$text['individuals'] = "Pessoas";  //from whats new
$text['families'] = "Famílias";
$text['personid'] = "ID da pessoa";
$text['sources'] = "Fontes";  //from getperson (next several)
$text['unknown'] = "Desconhecido";
$text['father'] = "Pai";
$text['mother'] = "Mãe";
$text['christened'] = "Foi baptizado";
$text['died'] = "Faleceu";
$text['buried'] = "Foi sepultado";
$text['spouse'] = "Cônjuge";  //from search
$text['parents'] = "Pais";  //from pedigree
$text['text'] = "Texto";  //from sources
$text['language'] = "Idioma";  //from languages
$text['descendchart'] = "Descendentes";
$text['extractgedcom'] = "GEDCOM";
$text['indinfo'] = "Pessoa";
$text['edit'] = "Editar";
$text['date'] = "Data";
$text['login'] = "Entrar (login)";
$text['logout'] = "Sair (logout)";
$text['groupsheet'] = "Ficha familiar";
$text['text_and'] = "e";
$text['generation'] = "Geração";
$text['filename'] = "Nome de ficheiro";
$text['id'] = "ID";
$text['search'] = "Pesquisar";
$text['user'] = "Utilizador";
$text['firstname'] = "Nome Próprio";
$text['lastname'] = "Apelido";
$text['searchresults'] = "Resultado da pesquisa";
$text['diedburied'] = "Falecido/Sep.";
$text['homepage'] = "Início";
$text['find'] = "Pesquisar...";
$text['relationship'] = "Parentesco";		//in German, Verwandtschaft
$text['relationship2'] = "Relação"; //different in some languages, at least in German (Beziehung)
$text['timeline'] = "Cronologia";
$text['yesabbr'] = "S";               //abbreviation for 'yes'
$text['divorced'] = "Divorciado(a)";
$text['indlinked'] = "Ligado a";
$text['branch'] = "Ramo";
$text['moreind'] = "Mais pessoas";
$text['morefam'] = "Mais famílias";
$text['surnamelist'] = "Lista de apelidos";
$text['generations'] = "Gerações";
$text['refresh'] = "Actualizar";
$text['whatsnew'] = "Últimas Alterações";
$text['reports'] = "Relatórios";
$text['placelist'] = "Lista de Locais";
$text['baptizedlds'] = "Baptismo (SUD)";
$text['endowedlds'] = "Investidura (SUD)";
$text['sealedplds'] = "Selamento aos pais (SUD)";
$text['sealedslds'] = "Selamento ao cônjuge (SUD)";
$text['ancestors'] = "Antepassados";
$text['descendants'] = "Descendentes";
//$text['sex'] = "Sex";
$text['lastimportdate'] = "Data da última importação de GEDCOM";
$text['type'] = "Tipo";
$text['savechanges'] = "Gravar as Alterações";
$text['familyid'] = "ID da Família";
$text['headstone'] = "Lápides";
$text['historiesdocs'] = "Histórias e Documentos";
$text['anonymous'] = "anónimo";
$text['places'] = "Locais";
$text['anniversaries'] = "Datas e Aniversários";
$text['administration'] = "Administração";
$text['help'] = "Ajuda";
//$text['documents'] = "Documents";
$text['year'] = "Ano";
$text['all'] = "Todos";
$text['address'] = "Endereço";
$text['suggest'] = "Sugestão de alteração";
$text['editevent'] = "Sugestão de alteração deste evento";
$text['morelinks'] = "Mais links";
$text['faminfo'] = "Dados da família";
$text['persinfo'] = "Dados da pessoa";
$text['srcinfo'] = "Dados da fonte";
$text['fact'] = "Facto";
$text['goto'] = "Seleccione uma página";
$text['tngprint'] = "Imprimir";
$text['databasestatistics'] = "Estatísticas"; //needed to be shorter to fit on menu
$text['child'] = "Filho(a)";  //from familygroup
$text['repoinfo'] = "Informação do Repositório";
$text['tng_reset'] = "Reinicializar";
$text['noresults'] = "Não foram encontrados resultados";
$text['allmedia'] = "Todos os media";
$text['repositories'] = "Repositórios";
$text['albums'] = "Álbuns";
$text['cemeteries'] = "Cemitérios";
$text['surnames'] = "Apelidos";
$text['dates'] = "Datas";
$text['link'] = "Link";
$text['media'] = "Media";
$text['gender'] = "Sexo";
$text['latitude'] = "Latitude";
$text['longitude'] = "Longitude";
$text['bookmarks'] = "Marcadores";
$text['bookmark'] = "Marcador";
$text['mngbookmarks'] = "Ir para Marcadores";
$text['bookmarked'] = "Marcador Adicionado";
$text['remove'] = "Remover";
$text['find_menu'] = "Pesquisas";
$text['info'] = "Info"; //this needs to be a very short abbreviation
$text['cemetery'] = "Cemitérios";
$text['gmapevent'] = "Mapa de Eventos";
$text['gevents'] = "Evento";
$text['googleearthlink'] = "Link para Google Earth";
$text['googlemaplink'] = "Link para Google Maps";
$text['gmaplegend'] = "Legenda de Pin";
$text['unmarked'] = "Não marcado";
$text['located'] = "Localizado";
$text['albclicksee'] = "Clicar para ver todos os itens neste álbum";
$text['notyetlocated'] = "Ainda não localizado";
$text['cremated'] = "Cremado(a)";
$text['missing'] = "Em falta";
$text['pdfgen'] = "Gerador de PDF";
$text['blank'] = "Diagrama Vazio";
$text['fonts'] = "Fontes";
$text['header'] = "Cabeçalho";
$text['data'] = "Dados";
$text['pgsetup'] = "Configuraçãoda Página";
$text['pgsize'] = "Tamanho da Página";
$text['orient'] = "Orientação"; //for a page
$text['portrait'] = "Ao alto (portrait)";
$text['landscape'] = "Ao baixo (landscape)";
$text['tmargin'] = " Margem Superior";
$text['bmargin'] = " Margem Inferior";
$text['lmargin'] = " Margem Esquerda";
$text['rmargin'] = " Margem Direita";
$text['createch'] = "Criar Diagrama";
$text['prefix'] = "Prefixo";
$text['mostwanted'] = "Mais Procurados";
$text['latupdates'] = "Últimas alterações";
$text['featphoto'] = "Fotografia do Dia";
$text['news'] = "Novidades";
$text['ourhist'] = "A História da Nossa Família";
$text['ourhistanc'] = "A História da Nossa Família e Antepassados";
$text['ourpages'] = "As Nossas Páginas de Genealogia da Família";
$text['pwrdby'] = "Este site é produzido com ";
$text['writby'] = "escrito por";
$text['searchtngnet'] = "Pesquisar na TNG Network (GENDEX)";
$text['viewphotos'] = "Ver todas as fotografias";
$text['anon'] = "Você está anónimo";
$text['whichbranch'] = "De que ramo é?";
$text['featarts'] = "Artigos Desenvolvidos";
$text['maintby'] = "Criado, gerido e actualizado por";
$text['createdon'] = "Criado em";
$text['reliability'] = "Fiabilidade";
$text['labels'] = "Etiquetas";
$text['inclsrcs'] = "Incluir Fontes";
$text['cont'] = "(cont.)"; //abbreviation for continued
$text['mnuheader'] = "Página Inicial";
$text['mnusearchfornames'] = "Pesquisar Pessoa";
$text['mnulastname'] = "Apelido";
$text['mnufirstname'] = "Nome Próprio";
$text['mnusearch'] = "Pesquisar";
$text['mnureset'] = "Repetir";
$text['mnulogon'] = "Entrar (login)";
$text['mnulogout'] = "Sair (logout)";
$text['mnufeatures'] = "Outros Recursos";
$text['mnuregister'] = "Registar-se como Utilizador";
$text['mnuadvancedsearch'] = "Pesquisa Avançada";
$text['mnulastnames'] = "Apelidos";
$text['mnustatistics'] = "Estatísticas";
$text['mnuphotos'] = "Fotografias";
$text['mnuhistories'] = "Histórias";
$text['mnumyancestors'] = "Fotografias e Histórias dos antepassados de [Person]";
$text['mnucemeteries'] = "Cemitérios";
$text['mnutombstones'] = "Lápides";
$text['mnureports'] = "Relatórios";
$text['mnusources'] = "Fontes";
$text['mnuwhatsnew'] = "Novidades";
$text['mnushowlog'] = "Registo de Acessos";
$text['mnulanguage'] = "Mudar de Idioma";
$text['mnuadmin'] = "Página da Administração";
$text['welcome'] = "Bem-vindo";
$text['contactus'] = "Contactar Connosco";
//changed in 8.0.0
$text['born'] = "Nascimento";
$text['searchnames'] = "Pesquisar Pessoas";
//added in 8.0.0
$text['editperson'] = "Editar Pessoa";
$text['loadmap'] = "Carregar o mapa";
$text['birth'] = "Nascimento";
$text['wasborn'] = "nasceu em";
$text['startnum'] = "Primeiro número";
$text['searching'] = "A Pesquisar";
//moved here in 8.0.0
$text['location'] = "Local";
$text['association'] = "Relacionamento";
$text['collapse'] = "Reduzir representação";
$text['expand'] = "Aumentar representação";
$text['plot'] = "Sepultura";
$text['searchfams'] = "Pesquisar Famílias";
//added in 8.0.2
$text['wasmarried'] = "casou com";
$text['anddied'] = "faleceu em";
//added in 9.0.0
$text['share'] = "Compartilhar";
$text['hide'] = "Ocultar";
$text['disabled'] = "A sua conta de utilizador foi desactivada. Por favor, contacte com o Administrador do site para mais informações.";
$text['contactus_long'] = "Se tem questões ou comentários sobre as informações contidas neste site, por favor <span class=\"emphasis\"><a href=\"suggest.php\">contacte-nos</a></span>. Esperamos a sua mensagem.";
$text['features'] = "Artigos";
$text['resources'] = "Recursos";
$text['latestnews'] = "Novidades";
$text['trees'] = "Árvores";
$text['wasburied'] = "foi sepultado em";
//moved here in 9.0.0
$text['emailagain'] = "Repita o e-mail";
$text['enteremail2'] = "Por favor, indique novamente o seu e-mail.";
$text['emailsmatch'] = "Os seus e-mails não coincidem. Por favor, introduza o mesmo e-mail em ambos os campos.";
$text['getdirections'] = "Clique para obter indicações sobre o caminho";
$text['calendar'] = "Calendário";
//changed in 9.0.0
$text['directionsto'] = " para ";
$text['slidestart'] = "Apresentação";
$text['livingnote'] = "Pelo menos uma pessoa marcada como 'viva' ou 'privada' está ligada a esta nota - os pormenores estão reservados.";
$text['livingphoto'] = "Pelo menos uma pessoa marcada como 'viva' ou 'privada' está ligada a este item - os pormenores estão reservados.";
$text['waschristened'] = "foi baptizado em";
//added in 10.0.0
$text['branches'] = "Ramos";
$text['detail'] = "Pormenor";
$text['moredetail'] = "Mais pormenores";
$text['lessdetail'] = "Menos pormenores";
$text['conflds'] = "Confirmação (SUD)";
$text['initlds'] = "Inicialização (SUD)";
$text['wascremated'] = "foi cremado";
//moved here in 11.0.0
$text['text_for'] = "para";
//added in 11.0.0
$text['searchsite'] = "Pesquisar neste site";
$text['searchsitemenu'] = "Pesquisa neste site";
$text['kmlfile'] = "Exporte um ficheiro .kml para mostrar esta localização no Google Earth";
$text['download'] = "Clique para exportar";
$text['more'] = "Mais";
$text['heatmap'] = "Distribuição no mapa";
$text['refreshmap'] = "Recarregar o mapa";
$text['remnums'] = "Limpar Números e Pins";
$text['photoshistories'] = "Fotografias e Histórias";
$text['familychart'] = "Diagrama familiar";
//added in 12.0.0
$text['firstnames'] = "Nomes Próprios";
//moved here in 12.0.0
$text['dna_test'] = "Teste de ADN";
$text['test_type'] = "Tipo de Teste";
$text['test_info'] = "Informação do Teste";
$text['takenby'] = "Indivíduo Examinado";
$text['haplogroup'] = "Haplogrupo";
$text['hvr1'] = "HVR1";
$text['hvr2'] = "HVR2";
$text['relevant_links'] = "Ligações relevantes";
$text['nofirstname'] = "[sem primeiro nome]";
//added in 12.0.1
$text['cookieuse'] = "NOTA: ESTE SITE USA COOKIES";
$text['dataprotect'] = "Política de Protecção de Dados";
$text['viewpolicy'] = "Ver a Política de Protecção de Dados";
$text['understand'] = "Compreendo e aceito";
$text['consent'] = "Autorizo que este site armazene os dados pessoais aqui fornecidos. Estou ciente de que posso solicitar em qualquer momento a remoção destes dados ao proprietário do site.";
$text['consentreq'] = "Por favor, dê o seu consentimento para que este site armazene os seus dados pessoais.";

//added in 12.1.0
$text['testsarelinked'] = "Os Testes de ADN estão associados com";
$text['testislinked'] = "O Teste de ADN está associado com";

//added in 12.2
$text['quicklinks'] = "Links Rápidos";
$text['yourname'] = "O seu nome";
$text['youremail'] = "O seu endereço de e-mail";
$text['liketoadd'] = "Qualquer informação que queira adicionar";
$text['webmastermsg'] = "Mensagem do webmaster";
$text['gallery'] = "Ver galeria";
$text['wasborn_male'] = "nasceu";  	// same as $text['wasborn'] if no gender verb
$text['wasborn_female'] = "nasceu"; 	// same as $text['wasborn'] if no gender verb
$text['waschristened_male'] = "foi baptizado";	// same as $text['waschristened'] if no gender verb
$text['waschristened_female'] = "foi baptizada";	// same as $text['waschristened'] if no gender verb
$text['died_male'] = "faleceu";	// same as $text['anddied'] of no gender verb
$text['died_female'] = "faleceu";	// same as $text['anddied'] of no gender verb
$text['wasburied_male'] = "foi sepultado"; 	// same as $text['wasburied'] if no gender verb
$text['wasburied_female'] = "foi sepultada"; 	// same as $text['wasburied'] if no gender verb
$text['wascremated_male'] = "foi cremado";		// same as $text['wascremated'] if no gender verb
$text['wascremated_female'] = "foi cremada";	// same as $text['wascremated'] if no gender verb
$text['wasmarried_male'] = "casou com";	// same as $text['wasmarried'] if no gender verb
$text['wasmarried_female'] = "casou com";	// same as $text['wasmarried'] if no gender verb
$text['wasdivorced_male'] = "divorciou-se";	// might be the same as $text['divorce'] but as a verb
$text['wasdivorced_female'] = "divorciou-se";	// might be the same as $text['divorce'] but as a verb
$text['inplace'] = " em ";			// used as a preposition to the location
$text['onthisdate'] = " em ";		// when used with full date
$text['inthisyear'] = " em ";		// when used with year only or month / year dates
$text['and'] = "e ";				// used in conjunction with wasburied or was cremated

//moved here in 12.2.1
$text['dna_info_head'] = "Informação do Teste de ADN";
//added in 13.0
$text['visitor'] = "Visitante";

$text['popupnote2'] = "Nova árvore de costado";

//moved here in 14.0
$text['zoomin'] = "Mais Zoom";
$text['zoomout'] = "Menos Zoom";
$text['scrollnote'] = "Arraste or role para ver o resto do diagrama.";
$text['general'] = "Geral";

//changed in 14.0
$text['otherevents'] = "Outros Eventos e Atributos";

//added in 14.0
$text['times'] = "-";
$text['connections'] = "Ligações";
$text['continue'] = "Continuar";
$text['title2'] = "Título"; //for media, sources, etc (not people)

@include_once(dirname(__FILE__) . "/alltext.php");
if(empty($alltextloaded)) getAllTextPath();
?>