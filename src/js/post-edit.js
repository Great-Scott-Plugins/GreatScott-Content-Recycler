import { compose } from '@wordpress/compose';
import { dispatch, select, subscribe, withDispatch, withSelect } from '@wordpress/data';
import { useEffect, useState } from '@wordpress/element';
import { __ } from '@wordpress/i18n';
import { registerPlugin } from '@wordpress/plugins';
import { PluginDocumentSettingPanel } from '@wordpress/edit-post';

/**
 * Content Recycler Panel.
 * @returns {JSX.Element}
 * @constructor
 */
const ContentRecyclerPanel = ( { setPostMeta, revisionId } ) => {
	const [ recycleType, setRecycleType ] = useState( '' );

	// Set post to locked on init.
	useEffect( () => {
		// Lock post editing.
		dispatch( 'core/editor' ).lockPostSaving( 'content-recycler' );
	}, [] );

	// Lock or unlock post based on recycle type.
	useEffect( () => {
		if ( '' === recycleType ) {
			dispatch( 'core/editor' ).lockPostSaving( 'content-recycler' );
		} else {
			dispatch( 'core/editor' ).unlockPostSaving( 'content-recycler' );
		}

		if ( 're-publish' === recycleType ) {
			setPostMeta( { recycle_id: String(revisionId) } );
		}
	}, [ recycleType ] );

	// Reset recycle type on successful save.
	subscribe( () => {
		const isSavingPost = select( 'core/editor' ).isSavingPost();
		const isAutosavingPost = select( 'core/editor' ).isAutosavingPost();

		if ( true === isAutosavingPost && false === isSavingPost ) {
			// Ignore auto-saves.
			return null;
		} else if ( false === isAutosavingPost && true === isSavingPost ) {
			// On save, set recycle type back to nada.
			setRecycleType( '' );
		}
	} );

	return (
		<PluginDocumentSettingPanel
			className="document-setting-content-recycler"
			title={ __( 'Content Recycler', 'greatscott-content-recycler' ) }
		>
			<select
				onChange={ event => setRecycleType( event.target.value ) }
				value={ recycleType }
			>
				<option value=""/>
				<option value="update-only">{ __( 'Update only', 'greatscott-content-recycler' ) }</option>
				<option value="re-publish">{ __( 'Re-publish', 'greatscott-content-recycler' ) }</option>
			</select>
		</PluginDocumentSettingPanel>
	);
};

const ContentRecyclerPanelWithCompose = compose( [
	withSelect( ( select ) => {
		return {
			postMeta: select( 'core/editor' ).getEditedPostAttribute( 'meta' ),
			revisionId: select( 'core/editor' ).getCurrentPostLastRevisionId(),
		};
	} ),
	withDispatch( ( dispatch ) => {
		return {
			setPostMeta( newMeta ) {
				dispatch( 'core/editor' ).editPost( { meta: newMeta } );
			},
		};
	} ),
] )( ContentRecyclerPanel );

registerPlugin( 'document-setting-content-recycler', { render: ContentRecyclerPanelWithCompose } );
