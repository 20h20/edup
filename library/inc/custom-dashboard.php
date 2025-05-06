<?php
	// Ordre des widgets dans le dashboard
	add_action('wp_dashboard_setup', 'set_dashboard_widget_order', 100);
	function set_dashboard_widget_order() {
		global $wp_meta_boxes;
		$wp_meta_boxes['dashboard']['normal']['core'] = array(
			'welcome_dashboard'      => array('id' => 'welcome_dashboard', 'title' => 'Bienvenue', 'callback' => 'display_welcome_message', 'args' => array()),
			'widget_page_populaire'  => array('id' => 'widget_page_populaire', 'title' => 'Page la plus vue', 'callback' => 'display_popular_page', 'args' => array()),
			'widget_top5_pages'      => array('id' => 'widget_top5_pages', 'title' => 'Top 3 des pages vues', 'callback' => 'display_popular_pages', 'args' => array()),
			'widget_website_views'     => array('id' => 'widget_website_views', 'title' => 'Nombre de visites', 'callback' => 'afficher_visites_site_widget', 'args' => array()),
			'widget_leads_cf7'       => array('id' => 'widget_leads_cf7', 'title' => 'Nombre de leads générés', 'callback' => 'display_leads_cf7_widget', 'args' => array()),
			'google_sheet_dashboard' => array('id' => 'google_sheet_dashboard', 'title' => 'Récapitulatif du temps', 'callback' => 'display_google_sheet_data', 'args' => array()),
		);

		$wp_meta_boxes['dashboard']['side']['core'] = array(
			'wpc_custom_activity' => array('id' => 'wpc_custom_activity', 'title' => 'Activité récente', 'callback' => 'wpc_dashboard_custom_activity', 'args' => array()),
		);
	}


	// Verrouillage du layout du dashboard
	add_action('admin_head-index.php', 'lock_dashboard_layout');
	function lock_dashboard_layout() {
		if (current_user_can('edit_dashboard')) {
			echo '<style>
				#dashboard-widgets .postbox-container { min-height: 0 !important; }
				.postbox .handlediv, .postbox h2.hndle { cursor: default !important; }
				.postbox .hndle { pointer-events: none; }
				.postbox .handle-actions, #screen-options-link, #screen-options-wrap { display: none !important; }
			</style>';
		}
	}


	// Widget Bienvenue
	function display_welcome_message() {
		$current_user = wp_get_current_user();
		$first_name = $current_user->user_firstname;
		if (empty($first_name)) {
			$first_name = esc_html($current_user->display_name);
		}
		echo "
		<div class='inside-content'>
			<strong>Bonjour $first_name, content de vous revoir 👋</strong>
			<p>Bienvenue sur le back-office de votre site internet.</p>
		</div>
		<a class='cbo-button' href='https://trello.com/b/nkbZe5M1/edup
		' target='_blank'>Suivi de vos tickets</a>";
	}


	// Widget page la plus vue
	function display_popular_page() {
		$query = new WP_Query([
			'post_type'	=> ['page', 'product', 'portfolio', 'application'],
			'meta_key'	=> 'compteur_vues',
			'orderby'	=> 'meta_value_num',
			'order'	=> 'DESC',
			'posts_per_page' => 1,
		]);
		if ($query->have_posts()) {
			$query->the_post();
			$vues = get_post_meta(get_the_ID(), 'compteur_vues', true);
			echo "<p><a href='" . get_permalink() . "' target='_blank'>" . get_the_title() . "</a></p>";
			echo "<p>Nombre de vues : <strong>$vues</strong></p>";
			wp_reset_postdata();
		} else {
			echo "<p>Aucune vue enregistrée pour le moment.</p>";
		}
	}


	// Widget Top 3 pages
	function display_popular_pages() {
		$query = new WP_Query([
			'post_type'	=> ['page', 'product', 'portfolio', 'application'],
			'meta_key'	=> 'compteur_vues',
			'orderby'	=> 'meta_value_num',
			'order'	=> 'DESC',
			'posts_per_page' => 4,
		]);

		if ($query->have_posts()) {
			echo "<ul>";
			$count = 0;
			while ($query->have_posts()) {
				$query->the_post();
				if ($count > 0) {
					$vues = get_post_meta(get_the_ID(), 'compteur_vues', true);
					echo "<li><a href='" . get_permalink() . "' target='_blank'>" . get_the_title() . "</a> <strong>{$vues} vues</strong></li>";
				}
				$count++;
			}
			echo "</ul>";
			wp_reset_postdata();
		} else {
			echo "<p>Aucune vue enregistrée pour le moment.</p>";
		}
	}


	// Widget visites du site
	function afficher_visites_site_widget() {
		$total = (int) get_option('site_total_visits', 0);
		echo "<p>Total des visites du site : <strong class='number'>{$total}</strong></p>";
	}
	function ajouter_widget_visites_site() {
		wp_add_dashboard_widget(
			'widget_visites_site',
			'Nombre de visites du site',
			'afficher_visites_site_widget'
		);
	}
	add_action('wp_dashboard_setup', 'ajouter_widget_visites_site');


	// Widget leads CF7
	function display_leads_cf7_widget() {
		$leads = get_option('compteur_leads_cf7', 0);
		echo "<p>Leads générés via les formulaires : <strong class='number'>{$leads}</strong></p>";
	}


	// Données Google Sheet (Time tracking)
	function get_google_sheet_json() {
		$url = 'https://docs.google.com/spreadsheets/d/1O6gYHNpGsmbp_II4bGP9gIsCEMx7uwuGvLL6ogdE5m4/gviz/tq?tqx=out:json';
		$response = wp_remote_get($url);

		if (is_wp_error($response)) return null;

		$json = wp_remote_retrieve_body($response);
		$json = str_replace(["/*O_o*/", "google.visualization.Query.setResponse("], '', $json);
		$json = substr($json, 0, -2);

		return json_decode($json, true);
	}

	function add_google_sheet_dashboard_widget() {
		$year = date('Y');
		wp_add_dashboard_widget(
			'google_sheet_dashboard',
			"Récapitulatif du temps passé sur le site en $year",
			'display_google_sheet_data'
		);
	}	
	add_action('wp_dashboard_setup', 'add_google_sheet_dashboard_widget');

	function display_google_sheet_data() {
		$data = get_google_sheet_json();
	
		if (!$data || !isset($data['table']['rows'])) {
			echo '<div class="inside">Aucune donnée disponible.</div>';
			return;
		}
	
		$totals = []; // Pour stocker les totaux à afficher en bas
	
		echo '<table style="width:100%; border-collapse: collapse;">';
		echo '<tr>
				<th style="width: 10%;">Date</th>
				<th style="width: 50%">Tâche effectuée</th>
				<th style="width: 10%">Temps passé</th>
				<th style="width: 10%">Prix</th>
				<th style="width: 20%">Facturé</th>
			  </tr>';
	
		foreach ($data['table']['rows'] as $row) {
			$date   = isset($row['c'][0]['v']) ? esc_html($row['c'][0]['v']) : '-';
			$task   = isset($row['c'][1]['v']) ? esc_html($row['c'][1]['v']) : '-';
			$time   = isset($row['c'][2]['v']) ? esc_html($row['c'][2]['v']) : '-';
			$price  = isset($row['c'][3]['v']) ? esc_html($row['c'][3]['v']) : '-';
			$billed = isset($row['c'][4]['v']) ? esc_html($row['c'][4]['v']) : '-';
	
			if ($date === '-' || stripos($date, 'Total') !== false) {
				$totals[] = ['date' => $date, 'time' => $time, 'price' => $price];
				continue;
			}
			// Exclure la ligne "Temps passé"
			if ($date === 'Temps passé') {
				continue;
			}

			$billed_class = strtolower($billed) === 'oui' ? 'billed--ok' : 'billed--nonok';

			echo "
			<tr>
				<td style='width: 10%;'>$date</td>
				<td style='width: 50%;'>$task</td>
				<td style='width: 10%;'>$time</td>
				<td style='width: 10%;'>$price €</td>
				<td style='width: 20%;'><span class='billed $billed_class'>$billed</span></td>
			</tr>";
		}

		// Affichage des totaux calculés à la fin
		if (!empty($totals)) {
			echo '<tfoot>';
			foreach ($totals as $total) {
				// Affiche "jour" uniquement si la cellule time n’est pas vide ou "-"
				$time_text = ($total['time'] !== '-' && !empty($total['time'])) ? $total['time'] . ' jour' : '';

				echo "<tr style='font-weight: bold; background-color: #f2f2f2;'>
						<td style='width:27%'>{$total['date']}</td>
						<td style='width:23%'>$time_text</td>
						<td style='width:45%'>{$total['price']} €</td>
					</tr>";
			}

			// Affichage du Total TTC si présent dans les totaux
			if (isset($total_ttc)) {
				echo "<tr style='font-weight: bold; background-color: #f2f2f2;'>
						<td>Total TTC</td>
						<td></td>
						<td>{$total_ttc} €</td>
					</tr>";
			}
			echo '</tfoot>';
		}
		echo '</table>';
	}


	// Widget activité récente (produits / portfolio)
	function wpc_dashboard_custom_activity() {
		$query = new WP_Query([
			'post_type'	=> ['casestudies', 'page'],
			'posts_per_page' => 6,
			'post_status'	=> 'publish',
			'orderby'	=> 'date',
			'order'	=> 'DESC'
		]);
		if ($query->have_posts()) {
			echo '<ul>';
			while ($query->have_posts()) {
				$query->the_post();
				echo '<li><i class="icon icon--devis"></i> <a href="' . get_edit_post_link() . '">' . get_the_title() . ' <span class="date">' . get_the_date() . '</span></a></li>';
			}
			echo '</ul>';
		} else {
			echo '<p>Aucun élément récent dans "Page" ou "Étude de cas".</p>';
		}
		wp_reset_postdata();
	}
?>